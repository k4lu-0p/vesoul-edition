<?php
//lol
namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\CommandRepository;

/**
 * @Route("/pannel-admin")
 */
class DashboardAdminController extends AbstractController
{
    /**
     * @Route("/accueil", name="dashboard_admin_home")
     */
    public function home()
    {
        return $this->render('dashboard-admin/home.html.twig', [
            'title' => 'Accueil',
        ]);
    }

    /**
     * @Route("/commandes", name="dashboard_admin_commandes")
     */
    public function commandes(CommandRepository $repo)
    {
        $allCommands = $repo->findAll();
        return $this->render('dashboard-admin/commandes.html.twig', [
            'title' => 'Commandes',
            'commands' => $allCommands,
        ]);
    }

    /**
     * @Route("/livres", name="dashboard_admin_livres")
     * @Route("/livres/modifier/{id}", name="dashboard_admin_modif_livres")
     */
    public function books(Request $request, BookRepository $repo, ObjectManager $manager)
    {
        $toggle = false;
        if($request->get('id')!= null){
            $toggle = $request->get('id');
            $book = $repo->findBy(['id' => $request->get('id')]);
            $book = $this->getDoctrine()->getRepository(Book::class)->find($request->get('id'));
        } else {
            $book = new Book();
        }

        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);
        $allBooks = $repo->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($book);
            $manager->flush();
            return $this->redirectToRoute('dashboard_admin_livres');
        } else {
            return $this->render('dashboard-admin/books.html.twig', [
                'title' => 'Livres',
                'books' => $allBooks,
                'form' => $form->createView(),
                'toggle' => $toggle,
                ]);
            }
    }

    /**
     * @Route("/pannel-admin/livres/redit/{id} ", name="dashboard_admin_redit_book")
     */
    public function reditBooks(Book $book, Request $request, ObjectManager $manager, RouterInterface $router )
    {
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);
 
         if ($form->isSubmitted() && $form->isValid()) {
           
            $manager->persist($book);
            $manager->flush();
            // return new RedirectResponse($router->generate('handle_tools'));
            return $this->redirectToRoute('dashboard_admin_livres');
 
        }
 
    }

    /**
     * @Route("/boutique", name="dashboard_admin_boutique")
     */
    public function info()
    {
        return $this->render('dashboard-admin/info.html.twig', [
            'title' => 'Information Boutique',
        ]);
    }

    /**
     * @Route("/mentions", name="dashboard_admin_mentions")
     */
    public function mentions()
    {
        return $this->render('dashboard-admin/mentions.html.twig', [
            'title' => 'Mentions légales',
        ]);
    }

}
