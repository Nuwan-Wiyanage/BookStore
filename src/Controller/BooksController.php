<?php
    namespace App\Controller;

    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;

    use App\Entity\ChildrenBooks;
    use App\Entity\FictionBooks;

    class BooksController extends AbstractController{
        /**
         * @Route("/", name="home")
         * @Method({"GET"})
         */
        public function index()
        {
            // $books = ['Book 1', 'Book 2', 'Book 3', 'Book 4', 'Book 5'];
            // return $this->render('books/index.html.twig', array('books' => $books));

            $childrenbooks = $this -> getDoctrine() -> getRepository(ChildrenBooks::class) -> findAll();
            $fictionbooks = $this -> getDoctrine() -> getRepository(FictionBooks::class) -> findAll();
            return $this->render('books/index.html.twig', array('childrenbooks' => $childrenbooks, 'fictionbooks' => $fictionbooks));
        }

        /**
         * @Route("/books/publish/children-books", name="publishChildrenBooks")
         * @Method({"GET", "POST"})
         */
        public function publishChildrenBooks(Request $request)
        {
            $childbook = new ChildrenBooks();
            $childbook -> setCurrency('LKR');
            $childbook -> setCategory('child');
            $childbook -> setImage('NULL');

            $form = $this->createFormBuilder($childbook)
                ->add('title', TextType::class, array('attr' =>[
                    'class' => 'form-control'
                    ]))
                ->add('description', TextareaType::class, array(
                    'required' => false, 
                    'attr' => [
                        'class' => 'form-control'
                    ]))
                ->add('price', TextType::class, array(
                    'attr' => [
                        'class' => 'form-control'
                    ]))
                ->add('currency', TextType::class, array(
                        'attr' => [
                            'class' => 'form-control'
                        ],
                        'required' => true,
                        'disabled' => true))
                ->add('category', ChoiceType::class, array(
                    'attr' => [
                        'class' => 'form-control'
                    ],
                    'placeholder' => 'Choose an option',
                    'required' => true,
                    'disabled' => true,
                    'choices' => [
                        'Children Books' => 'child',
                        'Fiction Books' => 'fiction',
                    ]))
                ->add('image', TextType::class, array(
                    'attr' => [
                        'class' => 'form-control'
                    ],
                    'disabled' => true))
                ->add('ageGroup', TextType::class, array(
                    'attr' => [
                        'class' => 'form-control'
                    ]))
                ->add('save', SubmitType::class, array(
                    'label' => 'Save',
                    'attr' => [
                        'class' => 'btn btn-primary mt-3'
                    ]))
                ->getForm();

            $form -> handleRequest($request);

            if($form -> isSubmitted() && $form -> isValid()){
                $childbook = $form -> getData();
                $entityManager = $this -> getDoctrine() -> getManager();
                $entityManager -> persist($childbook);
                $entityManager -> flush();

                $this->addFlash('success', 'Your book is published in children books category successfully !!!');
            }

            return $this->render('books/publishBooks.html.twig', array(
                'form' => $form->createView()
            ));
        }

        /**
         * @Route("/books/publish/fiction-books", name="publishFictionBooks")
         * @Method({"GET", "POST"})
         */
        public function publishFictionBooks(Request $request)
        {
            $fictionbook = new FictionBooks();
            $fictionbook -> setCurrency('LKR');
            $fictionbook -> setCategory('fiction');
            $fictionbook -> setImage('NULL');

            $form = $this->createFormBuilder($fictionbook)
                ->add('title', TextType::class, array('attr' =>[
                    'class' => 'form-control'
                    ]))
                ->add('description', TextareaType::class, array(
                    'required' => false, 
                    'attr' => [
                        'class' => 'form-control'
                    ]))
                ->add('price', TextType::class, array(
                    'attr' => [
                        'class' => 'form-control'
                    ]))
                ->add('currency', TextType::class, array(
                        'attr' => [
                            'class' => 'form-control'
                        ],
                        'required' => true,
                        'disabled' => true))
                ->add('category', ChoiceType::class, array(
                    'attr' => [
                        'class' => 'form-control'
                    ],
                    'placeholder' => 'Choose an option',
                    'required' => true,
                    'disabled' => true,
                    'choices' => [
                        'Children Books' => 'child',
                        'Fiction Books' => 'fiction',
                    ]))
                ->add('image', TextType::class, array(
                    'attr' => [
                        'class' => 'form-control'
                    ],
                    'disabled' => true))
                ->add('bookType', TextType::class, array(
                    'attr' => [
                        'class' => 'form-control'
                    ]))
                ->add('save', SubmitType::class, array(
                    'label' => 'Save',
                    'attr' => [
                        'class' => 'btn btn-primary mt-3'
                    ]))
                ->getForm();

            $form -> handleRequest($request);

            if($form -> isSubmitted() && $form -> isValid()){
                $fictionbook = $form -> getData();
                $entityManager = $this -> getDoctrine() -> getManager();
                $entityManager -> persist($fictionbook);
                $entityManager -> flush();

                $this->addFlash('success', 'Your book is published in fiction books category successfully !!!');
            }

            return $this->render('books/publishBooks.html.twig', array(
                'form' => $form->createView()
            ));
        }

        /**
         * @Route("/children/books", name="cildrenBooks")
         * @Method({"GET"})
         */
        public function getChildrenBooks()
        {
            $childrenbooks = $this -> getDoctrine() -> getRepository(ChildrenBooks::class) -> findAll();
            return $this->render('books/chidrenBooks.html.twig', array('childrenBooks' => $childrenbooks));
        }

        /**
         * @Route("/fiction/books", name="fictionBooks")
         * @Method({"GET"})
         */
        public function getFictionBooks()
        {
            $fictionbooks = $this -> getDoctrine() -> getRepository(FictionBooks::class) -> findAll();
            return $this->render('books/fictionBooks.html.twig', array('fictionBooks' => $fictionbooks));
        }

        /**
         * @Route("/aboutUs", name="aboutUs")
         * @Method({"GET"})
         */
        public function getAboutUs()
        {
            return $this->render('includes/aboutUs.html.twig');
        }

        /**
         * @Route("/books/child/detail/{id}", name="childBookDetails")
         * @Method({"GET"})
         */
        public function getChildBookDetails($id)
        {
            $book = $this -> getDoctrine() -> getRepository(ChildrenBooks::class) -> find($id);
            return $this->render('books/details.html.twig', array('book' => $book, 'parentRoute' => '/children/books'));
        }


        /**
         * @Route("/books/fiction/detail/{id}", name="fictionBookDetails")
         * @Method({"GET"})
         */
        public function getFictionBookDetails($id)
        {
            $book = $this -> getDoctrine() -> getRepository(FictionBooks::class) -> find($id);
            return $this->render('books/details.html.twig', array('book' => $book, 'parentRoute' => '/fiction/books'));
        }

    }