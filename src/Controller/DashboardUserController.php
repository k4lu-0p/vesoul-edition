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
     */
    public function showAccount(Request $request, ObjectManager $manager)
    {
        $user = new User();

        $form = $this->createForm(EditInformationsType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $manager->persist($user);
            $manager->flush();
            
            // return $this->redirectToRoute('');
        }
        // dump($form);

        // die();
        return $this->render('dashboard-user/mon-compte.html.twig', [
            'form' => $form->createView()
        ]);
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
