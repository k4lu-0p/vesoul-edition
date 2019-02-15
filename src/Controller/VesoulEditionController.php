<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class VesoulEditionController extends AbstractController
{
    /**
     * @Route("/", name="vesoul_edition_home")
     */
    public function home()
    {
        return $this->render('vesoul-edition/home.html.twig');
    }

    /**
     * @Route("/product", name="product")
     */
    public function showProduct()
    {
        return $this->render('front/product.html.twig');
    }

    /**
     * @Route("/panier", name="panier")
     */
    public function showPanier()
    {
        return $this->render('vesoul-edition/panier.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    /**
     * @Route("/commande", name="commander")
     */
    public function showCommande()
    {
        return $this->render('vesoul-edition/commande.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

}
// lol