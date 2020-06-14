<?php

namespace App\Repository;

use App\Entity\FictionBooks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FictionBooks|null find($id, $lockMode = null, $lockVersion = null)
 * @method FictionBooks|null findOneBy(array $criteria, array $orderBy = null)
 * @method FictionBooks[]    findAll()
 * @method FictionBooks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FictionBooksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FictionBooks::class);
    }

    // /**
    //  * @return FictionBooks[] Returns an array of FictionBooks objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FictionBooks
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
