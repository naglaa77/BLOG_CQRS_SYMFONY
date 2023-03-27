<?php

namespace App\Command\Handler;

use App\Entity\Article;
use App\Entity\Category;
use App\Command\CreateArticleCommand;
use Doctrine\ORM\EntityManagerInterface;

class CreateArticleHandler
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(CreateArticleCommand $command):Article
    {
        $article = new Article();
        $article->setTitle($command->getTitle());
        $article->setDescription($command->getDescription());
        $article->setCreatedAt(new \DateTime());
        $categoryId = $command->getCategoryId();
        if ($categoryId) {
            $category = $this->entityManager->getReference(Category::class, $categoryId);
            $article->setCategory($category);
        }

        $this->entityManager->persist($article);
        $this->entityManager->flush();
        
        return $article;

    }


}