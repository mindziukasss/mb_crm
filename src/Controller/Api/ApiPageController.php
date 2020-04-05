<?php


namespace App\Controller\Api;

use App\Repository\CrmPageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class ApiPageController
 */
class ApiPageController extends AbstractController
{
    /**
     * @Route("/api/page/{slug}", name="api_page")
     * @param CrmPageRepository $pageRepository
     * @param                   $slug
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getPageApi(CrmPageRepository $pageRepository, $slug)
    {
        return $this->json( $pageRepository->getPage($slug), 200, [], []);
    }

    /**
     * @Route("/api/menu", name="api_menu")
     * @param CrmPageRepository $pageRepository
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getMenuFromPageApi(CrmPageRepository $pageRepository)
    {
       $menu = $pageRepository->getMenu();
       $subMenu = $pageRepository->getSubMenu();

       foreach ($subMenu as $value) {
           foreach ($menu as &$item) {
               if ($value['menuId'] === $item['menuId']) {
                   $item['subMenu'][] = $value;
               }
           }
       }

        return $this->json( $menu, 200, [], []);
    }

    /**
     * @Route("/api/{slug}", name="api_gallery")
     * @param CrmPageRepository $pageRepository
     * @param                   $slug
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    public function getGalleryApi(CrmPageRepository $pageRepository, $slug)
    {
        $serializer = new Serializer([new ObjectNormalizer()]);
       $data = $serializer->normalize($pageRepository->getGallery($slug), null,
          [AbstractNormalizer::ATTRIBUTES => ['title', 'description', 'type',
              'gallery' => ['title',
                  'media' => ['fileName', 'attributeAlt']
              ]]
          ]);

       return $this->json( $data, 200, [], []);;
    }

}