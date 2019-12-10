<?php

namespace App\Controller\AdminPanel;

use App\Entity\CrmGallery;
use App\Entity\CrmMedia;
use App\Form\AdminPanel\Gallery\CrmGalleryType;
use App\Paginator\PaginatorItemsList;
use App\Repository\CrmGalleryRepository;
use App\Service\UploaderHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints\File;

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

    /**
     * @Route("/{id}/edit", name="crm_gallery_edit", methods={"GET","POST"})
     * @param EntityManagerInterface $em
     * @param Request                $request
     *
     * @param CrmGallery             $crmGallery
     *
     * @return Response
     */
    public function edit(EntityManagerInterface $em, Request $request, CrmGallery $crmGallery): Response
    {
        $form = $this->createForm(CrmGalleryType::class, $crmGallery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var CrmGallery $menu */
            $gallery = $form->getData();

            $em->persist($gallery);
            $em->flush();

            $this->addFlash('success', 'Gallery Update!');

            return $this->redirectToRoute('crm_gallery_index');

        }

        return $this->render(
            'adminPanel/gallery/edit.html.twig',
            [
                'galleryForm' => $form->createView(),
                'crmGallery' => $crmGallery
            ]
        );
    }


    /**
     * @Route("/{id}/media", name="crm_gallery", methods={"POST"})
     * @param CrmGallery             $crmGallery
     * @param Request                $request
     * @param UploaderHelper         $uploaderHelper
     * @param EntityManagerInterface $entityManager
     * @param ValidatorInterface     $validator
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Exception
     */
    public function uploadMedia(CrmGallery $crmGallery, Request $request, UploaderHelper $uploaderHelper, EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        /** @var UploadedFile $uploadedFile */
        $uploadedFile = $request->files->get('media');
        $violations = $validator->validate(
            $uploadedFile,
            [
                new NotBlank([
                    'message' => 'Please select a file to upload'
                ]),
                new File([
                    'maxSize' => '5M',
                    'mimeTypes' => [
                        'image/*',
                    ]
                ])
            ]
        );
        if ($violations->count() > 0) {
            /** @var ConstraintViolation $violation */
            $violation = $violations[0];
            return $this->json($violations, 400);
        }
        $filename = $uploaderHelper->uploadGalleryImage($uploadedFile,false);
        $media = new CrmMedia($crmGallery);
        $media->setFilename($filename);
        $media->setOriginalFilename($uploadedFile->getClientOriginalName() ?? $filename);
        $media->setMimeType($uploadedFile->getMimeType() ?? 'application/octet-stream');
        $media->setGallery($crmGallery);
        $entityManager->persist($media);
        $entityManager->flush();
        return $this->json(
            $media,
            201,
            [],
            [
                'groups' => ['main']
            ]
        );
    }
}