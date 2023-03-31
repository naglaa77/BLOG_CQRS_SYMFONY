<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $user = new User();
        $user->setEmail($faker->email());
        $user->setFirstName($faker->firstName());
        $user->setLastName($faker->lastName());
        $user->setPassword($faker->password());
        $manager->persist($user);

    

        $manager->flush();
    }
}
