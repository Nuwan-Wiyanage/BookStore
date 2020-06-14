<?php

namespace App\Repository;

use App\Entity\Coupens;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Coupens|null find($id, $lockMode = null, $lockVersion = null)
 * @method Coupens|null findOneBy(array $criteria, array $orderBy = null)
 * @method Coupens[]    findAll()
 * @method Coupens[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoupensRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Coupens::class);
    }

    // /**
    //  * @return Coupens[] Returns an array of Coupens objects
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
    public function findOneBySomeField($value): ?Coupens
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
