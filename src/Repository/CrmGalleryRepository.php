<?php

namespace App\Repository;

use App\Entity\CrmGallery;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class CrmGalleryRepository
 *
 * @method CrmGallery|null find($id, $lockMode = null, $lockVersion = null)
 * @method CrmGallery|null findOneBy(array $criteria, array $orderBy = null)
 * @method CrmGallery[]    findAll()
 * @method CrmGallery[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CrmGalleryRepository extends ServiceEntityRepository
{
    /**
     * CrmGalleryRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CrmGallery::class);
    }

    // /**
    //  * @return CrmGallery[] Returns an array of CrmGallery objects
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
    public function findOneBySomeField($value): ?CrmGallery
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
