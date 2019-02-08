<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BackController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function home()
    {
        return $this->render('back/home.html.twig', [
            'title' => 'Accueil',
        ]);
    }
    /**
     * @Route("/dashboard/commandes", name="dashboard-commandes")
     */
    public function commandes()
    {
        return $this->render('back/commandes.html.twig', [
            'title' => 'Commandes',
        ]);
    }
    /**
     * @Route("/dashboard/livres", name="dashboard-livres")
     */
    public function books()
    {
        return $this->render('back/books.html.twig', [
            'title' => 'Livres',
        ]);
    }
    /**
     * @Route("/dashboard/info-boutique", name="info-boutique")
     */
    public function info()
    {
        return $this->render('back/info.html.twig', [
            'title' => 'Information Boutique',
        ]);
    }
    /**
     * @Route("/dashboard/mentions", name="mentions")
     */
    public function mentions()
    {
        return $this->render('back/mentions.html.twig', [
            'title' => 'Mentions légales',
        ]);
    }
}
