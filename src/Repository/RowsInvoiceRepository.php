<?php

namespace App\Repository;

use App\Entity\RowsInvoice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RowsInvoice|null find($id, $lockMode = null, $lockVersion = null)
 * @method RowsInvoice|null findOneBy(array $criteria, array $orderBy = null)
 * @method RowsInvoice[]    findAll()
 * @method RowsInvoice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RowsInvoiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RowsInvoice::class);
    }

    // /**
    //  * @return RowsInvoice[] Returns an array of RowsInvoice objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RowsInvoice
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
