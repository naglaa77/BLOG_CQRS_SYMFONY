<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        $categories = [];
        for ($j=0; $j < 5;$j++) 
        {
            $category = new Category();
            $category->setName($faker->word(3,true));
            $manager->persist($category);
            $categories[] = $category;
        }
        for ($i = 0; $i < 40; $i++) {
                $article = new Article();
                $article->setTitle($faker->sentence);
                $article->setDescription($faker->text);
                $article->setCreatedAt($faker->dateTimeBetween('-1 years', 'now'));

                // Randomly assign a category to the article
                $categoryIndex = $faker->numberBetween(0, count($categories) - 1);
                $article->setCategory($categories[$categoryIndex]);
                $manager->persist($article);
            }

        $manager->flush();
    }
}
