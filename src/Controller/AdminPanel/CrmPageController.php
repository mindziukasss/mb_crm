<?php

namespace App\Controller\AdminPanel;

use App\Controller\BaseController;
use App\Entity\CrmPage;
use App\Entity\CrmSubMenu;
use App\Form\AdminPanel\Page\CrmPageType;
use App\Paginator\PaginatorItemsList;
use App\Repository\CrmPageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/new", name="crm_page_new", methods={"GET","POST"})
     * @param EntityManagerInterface $em
     * @param Request                $request
     *
     * @return Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function new(EntityManagerInterface $em, Request $request): Response
    {
        $form = $this->createForm(CrmPageType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var CrmPage $page */
            $page = $form->getData();

            if ($page->getSubMenu()) {
                $subMenu = $em->getRepository(CrmSubMenu::class)->find($page->getSubMenu());
                $page->setSubMenu($subMenu);
            }

            $em->persist($page);
            $em->flush();

            $this->addFlash('success', 'Page Created!');

            return $this->redirectToRoute('crm_page_index');

        }

        return $this->render(
            'adminPanel/page/new.html.twig',
            [
                'pageForm' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/new/sub-menu", name="crm_page_sub_menu")
     * @param Request $request
     *
     * @return Response
     */
    public function getSubMenu(Request $request)
    {
        $page = new CrmPage();
        $page->setMenu($request->query->get('location'));
        $form = $this->createForm(CrmPageType::class, $page);

        if (!$form->has('subMenu')) {
            return new Response(null, 204);
        }

        return $this->render('adminPanel/page/_subMenu.html.twig', [
            'subMenuForm' => $form->createView()
        ]);
    }
}