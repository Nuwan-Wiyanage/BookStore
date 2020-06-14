<?php

namespace App\Repository;

use App\Entity\ChildrenBooks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ChildrenBooks|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChildrenBooks|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChildrenBooks[]    findAll()
 * @method ChildrenBooks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChildrenBooksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChildrenBooks::class);
    }

    // /**
    //  * @return ChildrenBooks[] Returns an array of ChildrenBooks objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ChildrenBooks
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
