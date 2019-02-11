<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;


class SecurityFrontController extends AbstractController
{
    /**
     * @Route("/connexion/user", name="security_front_login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('securityFront/connexionSecurityFront.html.twig', [
            'title' => "Connexion utilisateur",
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    /**
    * @Route("/deconnexion/user", name="security_front_logout")
    *
    */
    public function logout() 
    {
        
    }
    

}
