<?php

namespace App\Repository;

use App\Entity\CrmSubMenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * Class CrmSubMenuRepository
 *
 * @method CrmSubMenu|null find($id, $lockMode = null, $lockVersion = null)
 * @method CrmSubMenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method CrmSubMenu[]    findAll()
 * @method CrmSubMenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CrmSubMenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CrmSubMenu::class);
    }

    /**
     * @return QueryBuilder
     */
    public function getSubMenuQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.deletedAt IS NULL')
            ->orderBy('s.createdAt', 'ASC');

    }

    /**
     * @param $position
     *
     * @param $menuId
     *
     * @return bool
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function isPosition($position, $menuId)
    {
        $data = $this->createQueryBuilder('s')
            ->andWhere('s.menu = :menuId AND s.position = :val AND s.deletedAt IS NULL')
            ->setParameter('val', $position)
            ->setParameter('menuId', $menuId)
            ->getQuery()
            ->getOneOrNullResult();

        return $data;
    }

    /**
     * @param $menuId
     *
     * @return mixed
     */
    public function getSubMenu($menuId)
    {
       $qb = $this->createQueryBuilder('s')
            ->select('s.id , s.title')
            ->andWhere('s.menu = :menuId AND s.deletedAt IS NULL')
            ->andWhere('s.enabled = :true')
            ->setParameter('menuId', $menuId)
            ->setParameter('true', 1)
            ->orderBy('s.title', 'DESC');

       return $qb->getQuery()->getResult();
    }


    // /**
    //  * @return CrmSubMenu[] Returns an array of CrmSubMenu objects
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
    public function findOneBySomeField($value): ?CrmSubMenu
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
