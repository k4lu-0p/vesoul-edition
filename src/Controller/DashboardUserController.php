<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AddressRepository;
use App\Repository\CommandRepository;
use App\Repository\BookRepository;
use App\Repository\AuthorRepository;
use App\Repository\UserRepository;
use App\Form\EditInformationsType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;


/**
 * @Route("/pannel-client")
 */
class DashboardUserController extends AbstractController
{

    /**
     * @Route("/accueil", name="dashboard_user_home")
     */
    public function home()
    {
        return $this->render('dashboard-user/mon-compte.html.twig', [
            'title' => 'Mon compte'
        ]);
    }


    /**
     * @Route("/informations", name="dashboard_user_informations")
     * 
     */
    public function showInformations(Request $request, ObjectManager $manager)
    {
        $user = $this->getUser();

        $form = $this->createForm(EditInformationsType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $manager->persist($user);
            $manager->flush();
            
            // return $this->redirectToRoute('');
        }

        // $repo = $this->getDoctrine()->getRepository(User::class);

        return $this->render('dashboard-user/mon-compte.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/informations/validation", name="dashboard_user_informations_validation")
     */
    public function infoValidation(Request $request, ObjectManager $manager)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        // dump($user);

        // die();
        
    	$form = $this->createForm(EditInformationsType::class, $user);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

            $error = $authenticationUtils->getLastAuthenticationError();
            $oldPassword = $authenticationUtils->getLastUsername();


            // $passwordEncoder = $this->get('security.password_encoder');
            // $oldPassword = $request->request->get('etiquettebundle_user')['oldPassword'];

            // Si l'ancien mot de passe est bon
            // if ($error->isPasswordValid($user, $oldPassword)) {
                
            //     $hash = $encoder->encodePassword($user, $user->getPassword()); // Chiffrer le mot de passe de l'user
                
            //     $username_mail = $user->getUsername();
            //     $tel = $user->getTel();
                
            //     $user->setPassword($hash) // Enregistrer le mot de passee chiffré en BDD
            //          ->setUsername($username_mail)
            //          ->setTel($tel);
                
            //     $em->persist($user);
            //     $em->flush();

            //     $this->addFlash('notice', 'Votre mot de passe à bien été changé !');

            //     return $this->redirectToRoute('security_user_login');
            // } else {
            //     $form->addError(new FormError('Ancien mot de passe incorrect'));
            // }
        }
    	
    	return $this->render('dashboard-user/mon-compte.html.twig', array(
    		'form' => $form->createView(),
        ));
        
    }

    /**
     * @Route("/adresses", name="dashboard_user_addresses")
     */
    public function showAdresses(AddressRepository $repo)
    {
        $adresses = $repo->findAll();
        return $this->render('dashboard-user/compte-adresses.html.twig', [
            'adresses' => $adresses
        ]);
    }

    /**
     * @Route("/ajouter-adresses", name="dashboard_user_add_addresses")
     */
    public function addAdresses()
    {
        return $this->render('dashboard-user/ajouter-adresses.html.twig');
    }

    /**
     * @Route("/commandes", name="dashboard_user_commands")
     */
    public function showCommandes(CommandRepository $repo)
    {
        $commandes = $repo->findAll();
        return $this->render('dashboard-user/compte-commandes.html.twig', [
            'commandes' => $commandes
        ]);
    }



}
