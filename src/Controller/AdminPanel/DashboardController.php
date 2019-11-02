<?php


namespace App\Controller\AdminPanel;

use App\Controller\BaseController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DashboardController
 *
 * @Route("/dasboard")
 */
class DashboardController extends BaseController
{

    /**
     * @Route("/" , name="crm_dasboard_index")
     */
    public function index()
    {
        return $this->render('adminPanel/dashboard/index.html.twig');
    }

}