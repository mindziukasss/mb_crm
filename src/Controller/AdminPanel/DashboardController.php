<?php


namespace App\Controller\AdminPanel;

use App\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DashboardController
 * @IsGranted("ROLE_ADMIN")
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