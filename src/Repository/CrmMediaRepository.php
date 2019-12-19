<?php

namespace App\Repository;

use App\Entity\CrmMedia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class CrmMediaRepository
 *
 * @method CrmMedia|null find($id, $lockMode = null, $lockVersion = null)
 * @method CrmMedia|null findOneBy(array $criteria, array $orderBy = null)
 * @method CrmMedia[]    findAll()
 * @method CrmMedia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CrmMediaRepository extends ServiceEntityRepository
{
    /**
     * CrmMediaRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CrmMedia::class);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getMedia($id)
    {
        $qb = $this->createQueryBuilder('m')
            ->select('m.id, m.fileName, m.size, m.originalFileName')
            ->andWhere('m.gallery = :galleryId AND m.deletedAt IS NULL')
            ->setParameter('galleryId', $id)
            ->orderBy('m.createdAt', 'DESC');

        return $qb->getQuery()->getResult();
    }

    // /**
    //  * @return CrmMedia[] Returns an array of CrmMedia objects
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
    public function findOneBySomeField($value): ?CrmMedia
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
