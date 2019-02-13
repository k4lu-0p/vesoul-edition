<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
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
        $hash = $this->passwordEncoder->encodePassword($user, "online@2017");

        $user->setFirstname("Lucas")
        ->setLastname("Robin")
        ->setEmail("lucas.rob1@live.fr")
        ->setTel("0649357680")
        ->setUsername("root")
        ->setRoles(["ROLE_USER"])
        ->setPassword($hash)
        ->setGender('homme')
        ->setNewsletter(true)
        ->setBirth(new \DateTime());
        
        $objectManager->persist($user);
        $objectManager->flush();
    }
}