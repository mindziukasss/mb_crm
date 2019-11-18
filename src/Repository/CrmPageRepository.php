<?php

namespace App\Repository;

use App\Entity\CrmPage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * Class CrmPageRepository
 *
 * @method CrmPage|null find($id, $lockMode = null, $lockVersion = null)
 * @method CrmPage|null findOneBy(array $criteria, array $orderBy = null)
 * @method CrmPage[]    findAll()
 * @method CrmPage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CrmPageRepository extends ServiceEntityRepository
{
    /**
     * CrmPageRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CrmPage::class);
    }

    /**
     * @return QueryBuilder
     */
    public function getPageQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.deletedAt IS NULL')
            ->orderBy('p.createdAt', 'ASC');
    }

    // /**
    //  * @return CrmPage[] Returns an array of CrmPage objects
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
    public function findOneBySomeField($value): ?CrmPage
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
