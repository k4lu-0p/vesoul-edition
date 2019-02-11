<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="dashboard")
     */
    public function home()
    {
        return $this->render('admin/home.html.twig', [
            'title' => 'Accueil',
        ]);
    }

    /**
     * @Route("/admin/commandes", name="dashboard-commandes")
     */
    public function commandes()
    {
        return $this->render('admin/commandes.html.twig', [
            'title' => 'Commandes',
        ]);
    }

    /**
     * @Route("/admin/livres", name="dashboard-livres")
     */
    public function books()
    {
        return $this->render('admin/books.html.twig', [
            'title' => 'Livres',
        ]);
    }

    /**
     * @Route("/admin/info-boutique", name="info-boutique")
     */
    public function info()
    {
        return $this->render('admin/info.html.twig', [
            'title' => 'Information Boutique',
        ]);
    }

    /**
     * @Route("/admin/mentions", name="mentions")
     */
    public function mentions()
    {
        return $this->render('admin/mentions.html.twig', [
            'title' => 'Mentions légales',
        ]);
    }


}
