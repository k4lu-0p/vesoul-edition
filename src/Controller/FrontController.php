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
     */
    public function showAccount()
    {
        return $this->render('front/mon-compte.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }
}