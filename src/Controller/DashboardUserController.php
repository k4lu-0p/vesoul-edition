<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Repository\AddressRepository;
use App\Repository\CommandRepository;
use App\Repository\BookRepository;
use App\Repository\AuthorRepository;
use App\Repository\UserRepository;
use App\Form\EditInformationsType;
use App\Form\AddAddressesType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Entity\Address;
use Symfony\Component\Form\FormError;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


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
    public function showInformations(Request $request, ObjectManager $manager, AuthenticationUtils $authenticationUtils, UserPasswordEncoderInterface $encoder)
    {
        $user = $this->getUser();

        $form = $this->createForm(EditInformationsType::class, $user);
        $form->handleRequest($request);


        //     $manager->persist($user);
        //     $manager->flush();
            
        
        if ($form->isSubmitted() && $form->isValid()) {

            // $passwordEncoder = 'bcrypt';
            // $oldPassword = $authenticationUtils->getLastUsername();
            // $oldPassword = $user->getPassword();

            // $valid = $passwordEncoder->encodePassword('online@2017', null);

            // dump($valid);
            // die();

            // $encoded = $encoder->encodePassword($user, $user->getPassword()); // Chiffrer le mot de passe de l'user

            
            // dump($oldPassword);
            // dump($user);
            // die();


            // $passwordEncoder = $this->container->get('security.encoder_factory');
            // $oldPassword = $request->request->get('etiquettebundle_user')['oldPassword'];
            
            // dump($user->isPasswordValid($user, $oldPassword));

            // die();

            // Si l'ancien mot de passe est bon
            // if ($user->isPasswordValid($user, $oldPassword)) {
                
                $em = $this->getDoctrine()->getManager();

                $hash = $encoder->encodePassword($user, $user->getPassword()); // Chiffrer le mot de passe de l'user
                
                $username_mail = $user->getUsername();
                $tel = $user->getTel();
                
                $user->setPassword($hash) // Enregistrer le mot de passee chiffré en BDD
                     ->setUsername($username_mail)
                     ->setTel($tel);
                
                $em->persist($user);
                $em->flush();

                $this->addFlash('notice', 'Votre mot de passe à bien été changé !');

                return $this->redirectToRoute('security_user_login');
            } else {
                $form->addError(new FormError('Ancien mot de passe incorrect'));

            }
        return $this->render('dashboard-user/mon-compte.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/adresses", name="dashboard_user_addresses")
     */
    public function showAdresses(AddressRepository $repo, Address $address = null, Request $request, ObjectManager $manager = null)
    {

        $user = $this->getUser();

        $id = $user->getId();

        if(!$address) {
            $address = new Address();
        }

        $form = $this->createForm(AddAddressesType::class, $address);
        $form->handleRequest($request);
        
        if($form->isSubmitted()) {
            
            // dump($address);
            // die();

            $manager->persist($address);
            $user->addAddress($address);
            $manager->flush();

            return $this->redirectToRoute('dashboard_user_addresses');
        }

        $adresses = $repo->findAddressByUserId($id);
        return $this->render('dashboard-user/compte-adresses.html.twig', [
            'adresses' => $adresses,
            'form' => $form->createView()
        ]);
    }
    

    /**
     * @Route("/adresses/{id}/delete", name="dashboard_user_addresses_delete")
     */
    public function delete($id, Address $address = null, Request $request, ObjectManager $manager)
    {
        
        $repo = $this->getDoctrine()->getRepository(Address::class);
        $address = $repo->find($id);
        
        $manager->remove($address);
        $manager->flush();
        
            // dump($address);
            // die();

            return $this->redirectToRoute('dashboard_user_addresses', ['id' => $adresse->getId()]);

    }


    /**
     * @Route("/commandes", name="dashboard_user_commands")
     */
    public function showCommandes(CommandRepository $repo_commande, AddressRepository $repo_adresse)
    {
        $user = $this->getUser();

        $id = $user->getId();

        $commandes = $repo_commande->findCommandByUserId($id);
        $addresses = $repo_adresse->findAddressByUserId($id);
        
        return $this->render('dashboard-user/compte-commandes.html.twig', [
            'commandes' => $commandes,
            'addresses' => $addresses
        ]);
    }



}
