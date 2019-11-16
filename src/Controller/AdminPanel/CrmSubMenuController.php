<?php

namespace App\Controller\AdminPanel;

use App\Controller\BaseController;
use App\Entity\CrmSubMenu;
use App\Form\AdminPanel\SubMenu\CrmSubMenuType;
use App\Paginator\PaginatorItemsList;
use App\Repository\CrmSubMenuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CrmSubMenuController
 *
 * @Route("/sub-menu")
 */
class CrmSubMenuController extends BaseController
{
    /**
     *
     * @Route("/", name="crm_sub_menu_index")
     * @param CrmSubMenuRepository $subMenuRepository
     * @param PaginatorItemsList   $paginatorItemsList
     *
     * @return Response
     */
    public function index(CrmSubMenuRepository $subMenuRepository, PaginatorItemsList $paginatorItemsList): Response
    {

        $queryBuilder = $subMenuRepository->getSubMenuQueryBuilder();

        return $this->render('adminPanel/subMenu/index.html.twig', [
            'crmSubMenus' => $paginatorItemsList->getPagination($queryBuilder)
        ]);
    }

    /**
     * @Route("/new", name="crm_sub_menu_new", methods={"GET","POST"})
     * @param EntityManagerInterface $em
     * @param Request                $request
     *
     * @return Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function new(EntityManagerInterface $em, Request $request): Response
    {
        $form = $this->createForm(CrmSubMenuType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var CrmSubMenu $subMenu */
            $subMenu = $form->getData();

            $em->persist($subMenu);
            $em->flush();

            $this->addFlash('success', 'Sub-menu Created!');

            return $this->redirectToRoute('crm_sub_menu_index');

        }

        return $this->render(
            'adminPanel/subMenu/new.html.twig',
            [
                'subMenuForm' => $form->createView(),
            ]
        );
    }

}
