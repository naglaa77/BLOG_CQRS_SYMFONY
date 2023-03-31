<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
 $faker = Factory::create();

        // Generate some categories
        $categories = [];
        for ($i = 0; $i < 5; $i++) {
            $category = new Category();
            $category->setName($faker->word());
            $manager->persist($category);
            $categories[] = $category;
        }

        // Generate some users
        $users = [];
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setEmail($faker->email());
            $user->setFirstName($faker->firstName());
            $user->setLastName($faker->lastName());
            $user->setPassword($faker->password());
            $manager->persist($user);
            $users[] = $user;
        }

        // Generate some articles
        for ($i = 0; $i < 20; $i++) {
            $article = new Article();
            $article->setTitle($faker->sentence());
            $article->setDescription($faker->text());
            $article->setCreatedAt($faker->dateTimeBetween('-1 year', 'now'));

            // Randomly assign a category to the article
            $categoryIndex = $faker->numberBetween(0, count($categories) - 1);
            $article->setCategory($categories[$categoryIndex]);

            // Randomly assign a user to the article
            $userIndex = $faker->numberBetween(0, count($users) - 1);
            $article->setUser($users[$userIndex]);

            $manager->persist($article);
        }

        $manager->flush();
    }
}
