<?php

namespace App\Repository;

use App\Entity\CrmMeniu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CrmMeniu|null find($id, $lockMode = null, $lockVersion = null)
 * @method CrmMeniu|null findOneBy(array $criteria, array $orderBy = null)
 * @method CrmMeniu[]    findAll()
 * @method CrmMeniu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CrmMeniuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CrmMeniu::class);
    }

    // /**
    //  * @return CrmMeniu[] Returns an array of CrmMeniu objects
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
    public function findOneBySomeField($value): ?CrmMeniu
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
