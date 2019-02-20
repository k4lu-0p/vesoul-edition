<?php
//lol
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BookRepository;

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
    public function commandes()
    {
        return $this->render('dashboard-admin/commandes.html.twig', [
            'title' => 'Commandes',
        ]);
    }

    /**
     * @Route("/livres", name="dashboard_admin_livres")
     */
    public function books(BookRepository $repo)
    {
        $books = $repo->findAll();
        return $this->render('dashboard-admin/books.html.twig', [
            'title' => 'Livres',
            'books' => $books,
        ]);
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
