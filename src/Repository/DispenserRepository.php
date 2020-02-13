<?php

namespace App\Repository;

use App\Entity\Dispenser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Dispenser|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dispenser|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dispenser[]    findAll()
 * @method Dispenser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DispenserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dispenser::class);
    }

    // /**
    //  * @return Dispenser[] Returns an array of Dispenser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Dispenser
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
