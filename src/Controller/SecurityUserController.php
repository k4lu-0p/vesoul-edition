<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Form\RegisterType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

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
    
    /**
    * @Route("/inscription", name="security_user_registration") 
    */ 
    public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {

        $user = new User();
        $form = $this->createForm(RegisterType::class, $user); // Créer le formulaire
        $form->handleRequest($request); // Bind automatique avec l'objet user des champs remplis dans le formulaire

        if($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getPassword()); // Chiffré le mot de passe de l'user
            $user->setPassword($hash); // Enregistrer le mot de passee chiffré en BDD
            $user->setRoles(['ROLE_USER']);

            $manager->persist($user); // Faire persister les données en BDD
            $manager->flush(); // Envois le tout en BDD
            
            return $this->redirectToRoute('security_user_login'); // Redirige sur la route de login (plus bas)
        }
     
        return $this->render('dashboard-user/inscription.html.twig', [
            'form' => $form->createView() // Rendu du formulaire
        ]);
    }
}
