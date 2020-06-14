<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Attribute\NamespacedAttributeBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;

use App\Entity\Book;
use App\Entity\ChildrenBooks;
use App\Entity\Coupens;
use App\Entity\FictionBooks;

use App\Utils\Cart;
use App\Utils\CartItem;

class CartController extends AbstractController{

    protected $cart;

    /**
     * The constructor
     */
    public function __construct()
    {
        $storage = new NativeSessionStorage();
        $attributes = new NamespacedAttributeBag();
        $this->session = new Session($storage, $attributes);
        $this->cart = new Cart($this->session);
    }

    /**
     * @Route("/book/detail/{id}", name="bookDetails")
     * @Method({"GET"})
     */
    public function getBookDetails(Book $bookModel)
    {
        $bookCategory = $bookModel->getCategory();
        if($bookCategory == "child"){
            $book = new ChildrenBooks();
        }
        else if($bookCategory == "fiction"){
            $book = new FictionBooks();
        }
        $book->title = $bookModel->getTitle();
        $book->description = $bookModel->getDescription();
        $book->price = $bookModel->getPrice();
        $book->category = $bookModel->getCategory();

        return $this->render('books/details.html.twig', array('book' => $book, 'parentRoute' => '/books/cart'));
    }

    /**
     * @Route("/books/cart", name="cart")
     * @Method({"GET"})
     */
    public function getCart()
    {
        $cart = $this->cart->getItems();
        return $this->render('books/cart.html.twig', ['cart' => $cart]);
    }

    /**
     *  Adds the book to cart list
     *
     * @Route("/cart/{id}", name="cart_add", requirements={"id": "\d+"}, methods="GET")
     */
    public function addToCartAction(Book $bookModel)
    {
        $item = new CartItem([
            'id' => $bookModel->getId(),
            'title' => $bookModel->getTitle(),
            'price' => $bookModel->getPrice(),
        ]);
        $item->setQuantity(1); // defaults to 1
        $item->setCategory($bookModel->getCategory());
        $this->cart->addItem($item);

        $this->addFlash('success', 'Book added to cart successfully.');

        return $this->redirectToRoute('home');
    }

    /**
     * Clears the cart
     *
     * @Route("/cart/clear", name="cart_clear")
     */
    public function clearCartAction()
    {
        $this->cart->clear();

        $this->addFlash('success', 'Cart cleared');

        return $this->redirectToRoute('home');
    }

    /**
     * Removes given book from the cart
     *
     * @Route("/cart/remove/{id}", name="cart_remove", requirements={"id": "\d+"})
     */
    public function removeCartAction(int $id)
    {
        $this->cart->removeItem($id);
        $this->addFlash('success', 'Book removed from the cart.');

        return $this->redirectToRoute('cart');
    }


    /**
     * Adds coupon to the cart
     *
     * @Route("/cart/add-coupon", name="coupon_add")
     */
    public function addCouponAction(Request $request)
    {
        $coupon = $request->get('coupon', null);

        if (! empty($coupon)) {
            //$coupons = $this -> getDoctrine() -> getRepository(Coupens::class) -> findAll();
            $coupons = $this -> getDoctrine() -> getRepository(Coupens::class) -> findBy(['coupen' => $coupon]);

            if (! isset($coupons[0])) {
                $this->addFlash('danger', 'Invalid Coupon.');
            }
            else{
                foreach ($coupons as $coup) {
                    if($coupon == $coup->getCoupen()){
                        $this->cart->setCoupon($coupon);
                        $this->addFlash('success', 'Coupon redeemed successfully.');
                    }
                    else{
                        $this->addFlash('danger', 'Invalid Coupon.');
                    }
                }
            }
        } else {
            $this->addFlash('danger', 'Coupon code cannot be empty.');
        }

        return $this->redirectToRoute('cart');
    }

    /**
     * Checkout process of the cart
     *
     * @Route("/cart/checkout", name="cart_checkout")
     */
    public function checkOutAction()
    {
        $this->addFlash('danger', 'This function not implemented. You can see the invoice details from the cartCoupon code cannot be empty.');
        return $this->redirectToRoute('cart'); 
    }

}