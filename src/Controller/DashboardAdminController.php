<?php
//lol
namespace App\Controller;

use App\Entity\Book;
use App\Entity\Admin;
use App\Form\BookType;
use App\Form\AdminType;
use App\Repository\BookRepository;
use App\Repository\AdminRepository;
use App\Repository\CommandRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Dompdf\Dompdf;
use Dompdf\Options;

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
     * @Route("/commandes/imprimer/{id}", name="dashboard_admin_commandes_imprime")
     */
    public function printBill(CommandRepository $repo)
    {

        $commande = $repo->findOneById(4);
        // $numero = $command->getNumber();
        // $date = $command->getDate();
        // $quantity = $command->getQuantity();
        // $totalCost = $command->getTotalcost();
        // $books = $command->getBooks();
        // $user = $command->getUser();
        // // $livraison = $command->getLivraison();
        // $facturation = $command->getFacturation();

         // Configure Dompdf according to your needs
         $pdfOptions = new Options();
         $pdfOptions->set('defaultFont', 'Arial');
         
         // Instantiate Dompdf with our options
         $dompdf = new Dompdf($pdfOptions);
         
         // Retrieve the HTML generated in our twig file
         $html = $this->render('bill/facture.html.twig', [
             'test' => $commande,
            //  'numero' => $numero,
            //  'date' => $date,
            //  'quantite' => $quantity,
            //  'total' => $totalCost,
            //  'livres' => $books,
            //  'utilisateur' => $user,
            //  'adresseLivraison' => $livraison,
            //  'adresseFacturation' => $facturation,
         ]);
        
         // Load HTML to Dompdf
         $dompdf->loadHtml($html);
         
         // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
         $dompdf->setPaper('A4', 'portrait');
 
         // Render the HTML as PDF
         $dompdf->render();
 
         // Output the generated PDF to Browser (force download)
         $dompdf->stream(".pdf", [
             "Attachment" => true
         ]);

         return $this->redirectToRoute('dashboard_admin_commandes');
        
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
     * @Route("/livres/redit/{id} ", name="dashboard_admin_redit_book")
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
    public function info(Request $request, AdminRepository $repo, ObjectManager $manager)
    {

        $toggle = false;
        if($request->get('id')!= null){
            $toggle = $request->get('id');
            $info = $repo->findBy(['id' => $request->get('id')]);
            $info = $this->getDoctrine()->getRepository(Admin::class)->find($request->get('id'));
        } else {
            $info = new Admin();
        }

        $form = $this->createForm(AdminType::class, $info);
        $form->handleRequest($request);
        $allInfo = $repo->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($info);
            $manager->flush();
            return $this->redirectToRoute('dashboard_admin_boutique');
        } else {
            return $this->render('dashboard-admin/info.html.twig', [
                'title' => 'Information Boutique',
                'infos' => $allInfo,
                'form' => $form->createView(),
                'toggle' => $toggle,
                ]);
            }
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
