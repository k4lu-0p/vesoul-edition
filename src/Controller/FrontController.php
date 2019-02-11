<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="front")
     */
    public function index()
    {
        return $this->render('front/index.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    /**
     * @Route("/product", name="product")
     */
    public function showProduct()
    {
        return $this->render('front/product.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    /**
     * @Route("/mon-compte", name="mon_compte")
     * @Route("/mon-compte/informations", name="compte-informations")
     */
    public function showAccount()
    {
        return $this->render('front/mon-compte.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    /**
     * @Route("/mon-compte/adresses", name="compte-adresses")
     */
    public function showAdresses()
    {
        return $this->render('front/compte-adresses.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    /**
     * @Route("/mon-compte/ajouter-adresses", name="ajouter-adresses")
     */
    public function addAdresses()
    {
        return $this->render('front/ajouter-adresses.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    /**
     * @Route("/mon-compte/commandes", name="compte-commandes")
     */
    public function showCommandes()
    {
        return $this->render('front/compte-commandes.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }
}
