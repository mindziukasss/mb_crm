<?php

namespace App\Controller\AdminPanel;

use App\Controller\BaseController;
use App\Paginator\PaginatorItemsList;
use App\Repository\CrmPageRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CrmPageController
 *
 * @Route("/page")
 */
class CrmPageController extends BaseController
{
    /**
     * @Route("/", name="crm_page_index")
     * @param CrmPageRepository  $pageRepository
     * @param PaginatorItemsList $paginatorItemsList
     *
     * @return Response
     */
    public function index(CrmPageRepository $pageRepository, PaginatorItemsList $paginatorItemsList): Response
    {
        return $this->render('adminPanel/page/index.html.twig', [
            'crmPages' => $paginatorItemsList->getPagination($pageRepository->getPageQueryBuilder())
        ]);
    }
}