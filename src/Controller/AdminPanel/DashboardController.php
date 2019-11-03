<?php


namespace App\Controller\AdminPanel;

use App\Controller\BaseController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DashboardController
 *
 * @Route("/dashboard")
 */
class DashboardController extends BaseController
{

    /**
     * @Route("/" , name="crm_dashboard_index")
     */
    public function index()
    {
        return $this->render('adminPanel/dashboard/index.html.twig');
    }

}