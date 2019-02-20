<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Command;
use App\Entity\Image;
use App\Entity\Book;
use App\Entity\Author;
use App\Entity\Address;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder) 
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $objectManager)
    {   
         // ==== Images ==========================================================
         $image1 = new Image();
        
         $image1->setUrl("/build/livre1.jpg");
 
         $objectManager->persist($image1);
         // -------------------------------------
         $image2 = new Image();
         
         $image2->setUrl("/build/livre2.jpg");
 
         $objectManager->persist($image2);
         // ------------------------------------
         $image3 = new Image();
         
         $image3->setUrl("/build/livre3.jpg");
 
         $objectManager->persist($image3);
         
        // ===== Books =====================================================
        $book1 = new Book();
        
        $book1->setDescription("C'est très le livre")
        ->setPrice(24)
        ->setIsbn(6486158165)
        ->setStock(5)
        ->setTitle("Le titre du livre")
        ->addImage($image1);

        $objectManager->persist($book1);
        // ---------------------------------------------
        $book2 = new Book();
        
        $book2->setDescription("Le deuxième de la saga")
        ->setPrice(20)
        ->setIsbn(6486158165)
        ->setStock(5)
        ->setTitle("Le titre du livre")
        ->addImage($image2);

        $objectManager->persist($book2);
        // ----------------------------------------------
        $book3 = new Book();
        
        $book3->setDescription("C'est très le super livre, à lire")
        ->setPrice(24)
        ->setIsbn(1351651364)
        ->setStock(5)
        ->setTitle("Le titre du livre")
        ->addImage($image3);

        $objectManager->persist($book3);

        // ===== Authors ========================================================
        $author1 = new Author();
        
        $author1->setFirstname("Alain")
        ->setLastname("Jean")
        ->addBook($book1);

        $objectManager->persist($author1);
        // ---------------------------------
        $author2 = new Author();
        
        $author2->setFirstname("Bernard")
        ->setLastname("Pinot")
        ->addBook($book2)
        ->addBook($book3);

        $objectManager->persist($author2);
        // ===== Commands ======================================================
        $command1 = new Command();
        
        $command1->setDate(new \DateTimeImmutable())
        ->setNumber(8657185758)
        ->setQuantity(2)
        ->setTotalcost(44)
        ->setState("en cours")
        ->addBook($book1);

        $objectManager->persist($command1);
        // ------------------------------------------
        $command2 = new Command();
        
        // $objectManager->flush();
        
        $command2->setDate(new \DateTimeImmutable())
        ->setNumber(8917186412)
        ->setQuantity(1)
        ->setTotalcost(22)
        ->setState("expédié")
        ->addBook($book1);
        
        $objectManager->persist($command2);
        // ------------------------------------------
        $command3 = new Command();


        $command3->setDate(new \DateTimeImmutable())
        ->setNumber(8917186412)
        ->setQuantity(1)
        ->setTotalcost(22)
        ->setState("expédié")
        ->addBook($book1);
        
        $objectManager->persist($command3);
        
        // ===== Adresses ======================================================
        $address1 = new Address();

        $address1->setNumber("2")
        ->setType("bis")
        ->setStreet("rue du pont")
        ->setCity("vesoul")
        ->setCp("70000")
        ->setCountry("France")
        ->setAdditional("appartement 12")
        ->setTitle("Maison")
        ->setFirstname("Jean")
        ->setLastname("Pierre");
        
        $objectManager->persist($address1);
        // -----------------------------------------
        $address2 = new Address();
        
        $address2->setNumber("7")
        ->setType("ter")
        ->setStreet("rue du chien")
        ->setCity("besançon")
        ->setCp("25000")
        ->setCountry("France")
        ->setAdditional("cave 5")
        ->setTitle("Bureau")
        ->setFirstname("Jean")
        ->setLastname("Pierre");

        $objectManager->persist($address2);
        // ----------------------------------------
        $address3 = new Address();

        $address3->setNumber("3")
        ->setType("bis")
        ->setStreet("rue du chat")
        ->setCity("dijon")
        ->setCp("39000")
        ->setCountry("France")
        ->setAdditional("terrain 1")
        ->setTitle("Voisin")
        ->setFirstname("Thomas")
        ->setLastname("Dujardin");
        
        $objectManager->persist($address3);
        
         // ===== User ======================================================
         $user = new User();
        
         $hash = $this->passwordEncoder->encodePassword($user, "online@2017");
         $user->setFirstname("Lucas")
         ->setLastname("Robin")
         ->setTel("0649357680")
         ->setUsername("lucas.rob1@live.fr")
         ->setRoles(["ROLE_USER"])
         ->setPassword($hash)
         ->setGender('homme')
         ->setNewsletter(true)
         ->setBirth(new \DateTime())
         ->addCommand($command1)
         ->addCommand($command2)
         ->addCommand($command3)
         ->addAddress($address1)
         ->addAddress($address2)
         ->addAddress($address3);
 
         $objectManager->persist($user);
 
         $objectManager->flush();
    }
}