<?php


namespace App\Controller\Api;

use App\Repository\CrmPageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
        return $this->json( $pageRepository->getPageApi($slug), 200, [], []);
    }
}