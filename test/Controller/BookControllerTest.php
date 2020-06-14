<?php
    namespace App\Tests\Controller;

    use App\Entity\ChildrenBooks;
    use App\Entity\FictionBooks;

    use PHPUnit\Framework\TestCase;

    class BooksControllerTest extends TestCase{
    
        public function indexTest()
        {
            $childrenbooks = $this -> getDoctrine() -> getRepository(ChildrenBooks::class) -> findAll();
            $fictionbooks = $this -> getDoctrine() -> getRepository(FictionBooks::class) -> findAll();
            
            $this->assertTrue($childrenbooks);
            $this->assertTrue($fictionbooks);
        }
    }