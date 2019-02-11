<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityBackController extends AbstractController
{
    /**
     * @Route("/connexion/admin", name="security_back_login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('securityAdmin/connexionSecurityAdmin.html.twig', [
            'title' => "Connexion administrateur",
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    /**
    * @Route("/deconnexion/admin", name="security_back_logout")
    *
    */
    public function logout() 
    {
        
    }
    

}
