<?php

namespace App\Controller\AdminPanel;

use App\Entity\CrmGallery;
use App\Form\AdminPanel\Gallery\CrmGalleryType;
use App\Paginator\PaginatorItemsList;
use App\Repository\CrmGalleryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CrmGalleryController
 *
 * @Route("/gallery")
 */
class CrmGalleryController extends AbstractController
{
    /**
     * @Route("/", name="crm_gallery_index")
     * @param CrmGalleryRepository $galleryRepository
     * @param PaginatorItemsList   $paginatorItemsList
     *
     * @return Response
     */
    public function index(CrmGalleryRepository $galleryRepository, PaginatorItemsList $paginatorItemsList): Response
    {
        return $this->render('adminPanel/gallery/index.html.twig', [
            'crmGalleries' => $paginatorItemsList->getPagination($galleryRepository->getGalleryQueryBuilder()),
        ]);
    }

    /**
     * @Route("/new", name="crm_gallery_new", methods={"GET","POST"})
     * @param EntityManagerInterface $em
     * @param Request                $request
     *
     * @return Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function new(EntityManagerInterface $em, Request $request): Response
    {
        $form = $this->createForm(CrmGalleryType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var CrmGallery $menu */
            $gallery = $form->getData();

            $em->persist($gallery);
            $em->flush();

            $this->addFlash('success', 'Gallery Created!');

            return $this->redirectToRoute('crm_gallery_index');

        }

        return $this->render(
            'adminPanel/gallery/new.html.twig',
            [
                'galleryForm' => $form->createView(),
            ]
        );
    }

}