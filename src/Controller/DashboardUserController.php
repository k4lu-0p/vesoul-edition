<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AddressRepository;
use App\Repository\CommandRepository;
use App\Repository\BookRepository;
use App\Repository\AuthorRepository;

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
        return $this->render('dashboard-user/mon-compte.html.twig', [
            'title' => 'Mon compte'
        ]);
    }

    /**
     * @Route("/informations", name="dashboard_user_informations")
     */
    public function showAccount()
    {
        return $this->render('dashboard-user/mon-compte.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    /**
     * @Route("/adresses", name="dashboard_user_addresses")
     */
    public function showAdresses(AddressRepository $repo)
    {
        $adresses = $repo->findAll();
        return $this->render('dashboard-user/compte-adresses.html.twig', [
            'controller_name' => 'FrontController',
            'adresses' => $adresses
        ]);
    }

    /**
     * @Route("/ajouter-adresses", name="dashboard_user_add_addresses")
     */
    public function addAdresses()
    {
        return $this->render('dashboard-user/ajouter-adresses.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    /**
     * @Route("/commandes", name="dashboard_user_commands")
     */
    public function showCommandes(CommandRepository $repo)
    {
        $commandes = $repo->findAll();
        return $this->render('dashboard-user/compte-commandes.html.twig', [
            'controller_name' => 'FrontController',
            'commandes' => $commandes
        ]);
    }



}
