<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 20; $i++) {
            $article = new Article();
            $article->setTitle($faker->sentence);
            $article->setDescription($faker->text);
            $article->setCreatedAt($faker->dateTimeBetween('-1 years', 'now'));

            $manager->persist($article);
        }

        $manager->flush();
    }
}
