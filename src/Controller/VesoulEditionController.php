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
        return $this->render('vesoul-edition/home.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

}
