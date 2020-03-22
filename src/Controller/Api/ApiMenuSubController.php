<?php


namespace App\Controller\Api;
use App\Repository\CrmMenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


/**
 * Class ApiMenuSubController
 */
class ApiMenuSubController extends AbstractController
{
    /**
     * @Route("/api/menu", name="api_menu")
     * @param CrmMenuRepository $menuRepository
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    public function getMenuSub(CrmMenuRepository $menuRepository)
    {

        $serializer = new Serializer([new ObjectNormalizer()]);

        $data = $serializer->normalize($menuRepository->getMenuAndSubmenu(), null,
            [AbstractNormalizer::ATTRIBUTES =>
                ['title',
                    'slug',
                    'subMenus' => ['title', 'slug', 'position']
                ]
            ]);
        return $this->json($data,
            200, [], []);
    }
}