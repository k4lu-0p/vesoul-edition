<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/pannel-client")
 */
class SecurityUserController extends AbstractController
{
    /**
     * @Route("/connexion", name="security_user_login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security-user/connexionSecurityUser.html.twig', [
            'title' => "Connexion utilisateur",
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    /**
    * @Route("/deconnexion", name="security_user_logout")
    *
    */
    public function logout() 
    {
        
    }
    

}
