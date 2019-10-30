<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeController
 */
class HomeController extends BaseController
{

    /**
     * @Route("/" , name="app_home")
     */
    public function home()
    {
        return new Response('Home page');
    }

}