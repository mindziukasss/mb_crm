<?php

namespace App\Repository;

use App\Entity\CrmSubMenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

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
