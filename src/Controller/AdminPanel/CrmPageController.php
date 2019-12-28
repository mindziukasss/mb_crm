<?php

namespace App\Controller\AdminPanel;

use App\Controller\BaseController;
use App\Entity\CrmGallery;
use App\Entity\CrmPage;
use App\Entity\CrmSubMenu;
use App\Form\AdminPanel\Page\CrmPageType;
use App\Paginator\PaginatorItemsList;
use App\Repository\CrmGalleryRepository;
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

            if ($page->getType() === 'gallery') {
                $gallery = $em->getRepository(CrmGallery::class)->find($page->getGallery());
                $page->setGallery($gallery);
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
     * @Route("/{id}/edit", name="crm_page_edit", methods={"GET","POST"})
     * @param EntityManagerInterface $em
     * @param Request                $request
     *
     * @param CrmPage                $crmPage
     *
     * @return Response
     */
    public function edit(EntityManagerInterface $em, Request $request, CrmPage $crmPage): Response
    {

        if ($crmPage->getSubMenu()) {
            $crmPage->setSubMenu($crmPage->getSubMenu()->getId());
        }

        if ($crmPage->getGallery()) {
            $crmPage->setGallery($crmPage->getGallery()->getId());
        }

        $form = $this->createForm(CrmPageType::class, $crmPage);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var CrmPage $page */
            $page = $form->getData();

            if ($page->getSubMenu()) {
                $subMenu = $em->getRepository(CrmSubMenu::class)->find($page->getSubMenu());
                $page->setSubMenu($subMenu);
            }

            if ($page->getType() === 'gallery') {
                $gallery = $em->getRepository(CrmGallery::class)->find($page->getGallery());
                $page->setGallery($gallery);
            }

            $em->persist($page);
            $em->flush();

            $this->addFlash('success', 'Page update!');

            return $this->redirectToRoute('crm_page_index');

        }

        return $this->render(
            'adminPanel/page/edit.html.twig',
            [
                'pageForm' => $form->createView(),
                'crmPage' => $crmPage
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

    /**
     * @Route("/new/gallery", name="crm_page_gallery")
     * @param Request              $request
     *
     * @param CrmGalleryRepository $galleryRepository
     *
     * @return Response
     */
    public function getGallery(Request $request, CrmGalleryRepository $galleryRepository)
    {

        $page = new CrmPage();
        $page->setType($request->query->get('location'));
        $form = $this->createForm(CrmPageType::class, $page);

        if (!$form->has('gallery')) {
            return new Response(null, 204);
        }

        return $this->render('adminPanel/page/_gallery.html.twig', [
            'form' =>$form->createView()
        ]);
    }

    /**
     * @Route("/{id}", name="crm_page_delete", methods={"DELETE"})
     *
     * @param CrmPage                $crmPage
     * @param EntityManagerInterface $em
     *
     * @return Response
     */
    public function delete(CrmPage $crmPage, EntityManagerInterface $em): Response
    {
        $em->remove($crmPage);
        $em->flush();

        return new Response('Delete page', Response::HTTP_OK);
    }

}