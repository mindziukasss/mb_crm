<?php

namespace App\Controller\AdminPanel;

use App\Entity\CrmGallery;
use App\Entity\CrmMedia;
use App\Repository\CrmMediaRepository;
use App\Service\UploaderHelper;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;


/**
 * Class CrmMediaController
 * @IsGranted("ROLE_ADMIN")
 * @Route("/media")
 */
class CrmMediaController extends AbstractController
{

    /**
     * @Route("/{id}/add", name="crm_media_add", methods={"POST"})
     *
     * @param CrmGallery             $crmGallery
     * @param Request                $request
     * @param UploaderHelper         $uploaderHelper
     * @param EntityManagerInterface $entityManager
     * @param ValidatorInterface     $validator
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Exception
     */
    public function addMedia(
        CrmGallery $crmGallery,
        Request $request,
        UploaderHelper $uploaderHelper,
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator
    ) :Response
    {
        /** @var UploadedFile $uploadedFile */
        $uploadedFile = $request->files->get('file');
        $violations = $validator->validate(
            $uploadedFile,
            [
                new NotBlank([
                    'message' => 'Please select a file to upload'
                ]),
                new File([
                    'maxSize' => '200M',
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
        $media->setSize($uploadedFile->getSize());
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

    /**
     * @Route("/{id}/remove", name="crm_media_delete", methods={"DELETE"})
     *
     * @param CrmMedia               $media
     * @param EntityManagerInterface $em
     * @param UploaderHelper         $uploaderHelper
     *
     * @return Response
     * @throws \League\Flysystem\FileNotFoundException
     */
    public function removeMedia(CrmMedia $media, EntityManagerInterface $em,  UploaderHelper $uploaderHelper): Response
    {
        $em->remove($media);
        $em->flush();

        $uploaderHelper->deleteFile('galleries/'.$media->getFileName());

        return new Response('Delete media', Response::HTTP_OK);
    }

    /**
     * @Route("/{id}", name="crm_media", methods={"GET"})
     *
     * @param CrmGallery         $crmGallery
     * @param CrmMediaRepository $mediaRepository
     *
     * @return object|null
     */
    public function getMedia(CrmGallery $crmGallery, CrmMediaRepository $mediaRepository): Response
    {
        $medias = $mediaRepository->getMedia($crmGallery->getId());

        return new JsonResponse([
            'medias' => $medias
        ]);

    }
}