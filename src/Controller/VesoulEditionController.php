<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\HttpFoundation\Session\Attribute\NamespacedAttributeBag;

use App\Repository\BookRepository;
use App\Repository\CartRepository;

use App\Entity\Book;

class VesoulEditionController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(SessionInterface $session)
    {
        
        // $session->invalidate();
        // if(!$session){
            $session->set('panier', []);
        // }

        $panier = $session->get('panier');
        $nbItems = count($panier);

        dump($session);

        return $this->render('vesoul-edition/home.html.twig', [
            'nbItems' => $nbItems
        ]);
    }

    /**
     * @Route("/panier/add/{id}", name="addItem")
     */
    public function addItem(SessionInterface $session, BookRepository $book)
    {
        $book = $repo->find($id);

        $id = $book->getId();
        $title = $book->getTitle();
        $author = $book->getAuthor();
        $price = $book->getPrice();

        $panier = $session->get('panier');

        $qantity = $panier[$id]['quantity']++;

        $panier[$id] = [
            'title'-> $title,
            'author'-> $author,
            'quantity'-> $quantity,
            'price'-> $price
        ];

        $session->set('panier', $panier);
        $panier = $session->get('panier');

        dump($session);

        $nbItems = count($panier);

        return $this->redirectToRoute('home');
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
    public function showPanier(SessionInterface $session)
    {
        return $this->render('vesoul-edition/panier.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    /**
     * @Route("/commande", name="commander")
     */
    public function showCommande(SessionInterface $session)
    {
        return $this->render('vesoul-edition/commande.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    /**
     * @Route("/confirmation", name="commander")
     */
    public function showConfirmation()
    {
        return $this->render('vesoul-edition/confirmation.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

}
// lol