<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Address;
// use Faker\Provider\bn_BD\Address;

class AddressFixtures extends Fixture
{
    public function load(ObjectManager $objectManager)
    {
        // $faker = Faker\Factory::create('FR_fr');

        // for ($i = 1; $i <= 10; $i++) {
        //     $address = new Address();
        //     $address->setNumber($faker->randomNumber(20))
        //             ->setType("bis")
        //             ->setStreet($faker->streetName())
        //             ->setCity($faker->city())
        //             ->setCp($faker->departmentNumber())
        //             ->setCountry($faker->country())
        //             ->setAdditional("appartement" . $faker->randomNumber(20));
        // }

        // $objectManager->persist($address);
        // $objectManager->flush();

        for ($i = 1; $i <= 3; $i++) {

            $address = new Address();

            $address->setNumber("2")
            ->setType("bis")
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