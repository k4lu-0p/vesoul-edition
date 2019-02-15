<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Command;
use App\Entity\Book;
use App\Entity\Author;
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
        $user = new User();
        $command = new Command();
        $book = new Book();
        $author = new Author();

        $hash = $this->passwordEncoder->encodePassword($user, "online@2017");

        $book->setDescription("C'est très le livre")
        ->setPrice(24)
        ->setIsbn(6486158165)
        ->setStock(5)
        ->setTitle("Le titre du livre");

        $author->setFirstname("Alain")
        ->setLastname("Jean")
        ->addBook($book);

        
        $command->setDate(new \DateTimeImmutable())
        ->setNumber(8657185758)
        ->setQuantity(2)
        ->setTotalcost(44)
        ->setState("en cours")
        ->addBook($book);

        $objectManager->persist($command);
        $command = new Command();
        
        // $objectManager->flush();
        
        $command->setDate(new \DateTimeImmutable())
        ->setNumber(8917186412)
        ->setQuantity(1)
        ->setTotalcost(22)
        ->setState("expédié")
        ->addBook($book);
        
        $objectManager->persist($command);
        $command = new Command();


        $command->setDate(new \DateTimeImmutable())
        ->setNumber(8917186412)
        ->setQuantity(1)
        ->setTotalcost(22)
        ->setState("expédié")
        ->addBook($book);
        
        $user->setFirstname("Lucas")
        ->setLastname("Robin")
        ->setEmail("lucas.rob1@live.fr")
        ->setTel("0649357680")
        ->setUsername("root")
        ->setRoles(["ROLE_USER"])
        ->setPassword($hash)
        ->setGender('homme')
        ->setNewsletter(true)
        ->setBirth(new \DateTime())
        ->addCommand($command);

        $objectManager->persist($command);
        $objectManager->persist($user);
        $objectManager->persist($book);
        $objectManager->persist($author);

        $objectManager->flush();
    }
}