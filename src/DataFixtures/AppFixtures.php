<?php

namespace App\DataFixtures;


use App\Entity\{UserTelephone,User};
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $operator = [50,67,63,68];

        $faker = Factory::create('uk_UA');
        for ($i = 0; $i <= 2000; $i++) {
            $randOperator = rand(0,3);
            $countryNumber = 380 .$operator[$randOperator].rand(1000000,9999999);

            $user = new User();
            $user->setName($faker->firstNameMale);
            $user->setDatebirth($faker->dateTimeBetween('-80 years','now'));

            for ($u = 1; $u <=  rand(1,3); $u++) {
                $telephone = new UserTelephone();
                $telephone->setTelephone($countryNumber);
                $telephone->setBalance($faker->numberBetween(-50,150));
                $telephone->setUserId($i);
                $manager->persist($telephone);
            }

            $manager->persist($user);
            $manager->flush();

        }

    }
}
