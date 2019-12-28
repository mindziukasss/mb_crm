<?php

namespace App\Repository;

use App\Entity\CrmMenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * Class CrmMenuRepository
 *
 * @method CrmMenu|null find($id, $lockMode = null, $lockVersion = null)
 * @method CrmMenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method CrmMenu[]    findAll()
 * @method CrmMenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 *
 */
class CrmMenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CrmMenu::class);
    }

    /**
     * @return QueryBuilder
     */
    public function getMenuQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.deletedAt IS NULL')
            ->orderBy('m.position', 'ASC');

    }

    /**
     * @param $position
     *
     * @return bool
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function isPosition($position)
    {

        $data =  $this  ->createQueryBuilder('m')
            ->andWhere('m.position = :val AND m.deletedAt IS NULL')
            ->setParameter('val', $position)
            ->getQuery()
            ->getOneOrNullResult();

        return $data;
    }

    // /**
    //  * @return CrmMenu[] Returns an array of CrmMenu objects
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
    public function findOneBySomeField($value): ?CrmMenu
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
