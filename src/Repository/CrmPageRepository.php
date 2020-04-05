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
            ->select('p, m, s')
            ->leftJoin('p.menu', 'm')
            ->leftJoin('p.subMenu', 's')
            ->andWhere('p.deletedAt IS NULL')
            ->orderBy('p.createdAt', 'ASC');
    }

    /**
     * @param $slug
     *
     * @return mixed
     */
    public function getPage($slug)
    {
        $qb = $this->createQueryBuilder('p')
            ->select('p.title, p.description')
            ->leftJoin('p.menu', 'm')
            ->leftJoin('p.subMenu', 's')
            ->setParameter('slug', $slug)
            ->Where('m.slug = :slug AND m.deletedAt IS NULL AND m.enabled = 1');

        return $qb->getQuery()->getResult();

    }

    /**
     * @return mixed
     */
    public function getMenu()
    {
        return $this->createQueryBuilder('p')
        ->select('p.type, m.id as menuId, m.title, m.slug, m.position')
        ->leftJoin('p.menu', 'm')
        ->andWhere('p.deletedAt IS NULL AND p.enabled = 1')
        ->distinct('menuId')
        ->orderBy('m.position', 'ASC')
        ->getQuery()->getResult();

    }

    /**
     * @return mixed
     */
    public function getSubMenu()
    {
        return $this->createQueryBuilder('p')
            ->select('m.id as menuId, s.id as subId, s.slug as subSlug, s.title as subTitle, s.position as subPosition')
            ->leftJoin('p.menu', 'm')
            ->leftJoin('p.subMenu', 's')
            ->andWhere('p.deletedAt IS NULL AND p.enabled = 1 AND s.id IS NOT NULL')
            ->orderBy('s.position', 'ASC')
            ->getQuery()->getResult();
    }

    /**
     * @param $slug
     *
     * @return mixed
     *
     */
    public function getGallery($slug)
    {
        return $this->createQueryBuilder('p')
            ->select('p, g, m')
            ->leftJoin('p.gallery', 'g')
            ->leftJoin('g.media', 'm')
            ->setParameter('type', $slug)
            ->andWhere('p.type = :type AND p.deletedAt IS NULL AND p.enabled = 1
              AND g.deletedAt IS NULL AND g.enabled = 1
              AND g.deletedAt IS NULL AND g.enabled = 1')
            ->getQuery()->getResult();

    }
}
