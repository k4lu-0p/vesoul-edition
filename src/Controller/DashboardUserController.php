<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pannel-client")
 */
class DashboardUserController extends AbstractController
{

    /**
     * @Route("/accueil", name="dashboard_user_home")
     */
    public function home()
    {
        return $this->render('dashboard-user/home.html.twig', [
            'title' => 'Mon compte'
        ]);
    }
}
