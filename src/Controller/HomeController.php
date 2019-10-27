<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeController
 */
class HomeController extends AbstractController
{

    /**
     * @Route("/" , name="app_home")
     */
    public function home()
    {
        return $this->render('base.html.twig');
    }

}