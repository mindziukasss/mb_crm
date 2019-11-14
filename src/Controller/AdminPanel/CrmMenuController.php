<?php


namespace App\Controller\AdminPanel;


use App\Controller\BaseController;
use App\Entity\CrmMenu;
use App\Form\AdminPanel\Menu\CrmMenuType;
use App\Repository\CrmMenuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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
            'crmMenus' => $menuRepository->findAllMenu(),
        ]);
    }

    /**
     * @Route("/new", name="crm_menu_new", methods={"GET","POST"})
     * @param EntityManagerInterface $em
     * @param Request                $request
     *
     * @return Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function new(EntityManagerInterface $em, Request $request): Response
    {
        $form = $this->createForm(CrmMenuType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var CrmMenu $menu */
            $menu = $form->getData();

                $em->persist($menu);
                $em->flush();

                $this->addFlash('success', 'Menu Created!');

                return $this->redirectToRoute('crm_menu_index');

        }

        return $this->render(
            'adminPanel/menu/new.html.twig',
            [
                'menuForm' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="crm_menu_edit", methods={"GET","POST"})
     * @param CrmMenu                $crmMenu
     * @param Request                $request
     *
     * @param EntityManagerInterface $em
     *
     * @return Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function edit(CrmMenu $crmMenu, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(CrmMenuType::class, $crmMenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var CrmMenu $menu */
            $menu = $form->getData();

                $em->persist($menu);
                $em->flush();

                $this->addFlash('success', 'Menu Update!');

                return $this->redirectToRoute('crm_menu_index');

        }

        return $this->render(
            'adminPanel/menu/edit.html.twig',
            [
                'menuForm' => $form->createView(),
                'crmMenu' => $crmMenu

            ]
        );
    }

    /**
     * @Route("/{id}", name="crm_menu_delete", methods={"DELETE"})
     * @param CrmMenu                $crmMenu
     * @param EntityManagerInterface $em
     *
     * @return Response
     */
    public function delete(CrmMenu $crmMenu, EntityManagerInterface $em): Response
    {
        $em->remove($crmMenu);
        $em->flush();

        return new Response('Delete menu', Response::HTTP_OK);

    }

}