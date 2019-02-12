<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Command;
// use Faker\Provider\bn_BD\Address;

class AddressFixtures extends Fixture
{
    public function load(ObjectManager $objectManager)
    {
       
        for ($i = 1; $i <= 3; $i++) {

            $address = new Command();

            $address->setUser(1)
            ->setdate("12/02")
            ->setStreet("rue du pont")
            ->setCity("vesoul")
            ->setCp("70000")
            ->setCountry("France")
            ->setAdditional("appartement 12");

            $objectManager->persist($address);
            $objectManager->flush();

            $address = new Address();

            $address->setNumber("7")
            ->setType("ter")
            ->setStreet("rue du chien")
            ->setCity("besançon")
            ->setCp("25000")
            ->setCountry("France")
            ->setAdditional("cave 5");

            $objectManager->persist($address);
            $objectManager->flush();

            $address = new Address();

            $address->setNumber("3")
            ->setType("bis")
            ->setStreet("rue du chat")
            ->setCity("dijon")
            ->setCp("39000")
            ->setCountry("France")
            ->setAdditional("terrain 1");

            $objectManager->persist($address);
            $objectManager->flush();
        }
    }
}