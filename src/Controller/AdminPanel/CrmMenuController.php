<?php


namespace App\Controller\AdminPanel;


use App\Controller\BaseController;
use App\Repository\CrmMenuRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CrmMenuController
 *
 * @Route("/menu")
 */
class CrmMenuController extends BaseController
{
    /**
     *
     * @Route("/", name="crm_menu_index")
     * @param CrmMenuRepository $menuRepository
     *
     * @return Response
     */
    public function index(CrmMenuRepository $menuRepository ): Response
    {

        return $this->render('adminPanel/menu/index.html.twig', [
            'crmMenus' => $menuRepository->findAll(),
        ]);
    }

}