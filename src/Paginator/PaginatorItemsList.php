<?php

namespace App\Paginator;

use Doctrine\ORM\QueryBuilder;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class PaginatorItemsList
 */
class PaginatorItemsList
{
    const LIMIT_PER_PAGE = 10;

    /**
     * @var null|\Symfony\Component\HttpFoundation\Request
     */
    private $request;
    /**
     * @var PaginatorInterface
     */
    private $paginator;

    /**
     * PaginatorItemsList constructor.
     *
     * @param RequestStack       $requestStack
     * @param PaginatorInterface $paginator
     */
    public function __construct(RequestStack $requestStack, PaginatorInterface $paginator)
    {
        $this->request = $requestStack->getCurrentRequest();
        $this->paginator = $paginator;
    }

    /**
     * @param QueryBuilder $qb
     * @param int          $perPage
     *
     * @return \Knp\Component\Pager\Pagination\PaginationInterface
     */
    public function getPagination(QueryBuilder $qb, int $perPage = self::LIMIT_PER_PAGE)
    {
        return $this->paginator->paginate(
            $qb,
            $this->request->query->getInt('page', 1),
            $perPage
        );
    }
}