<?php

namespace App\Command\Handler;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use App\Command\CreateArticleCommand;

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

        $this->entityManager->persist($article);
        $this->entityManager->flush();

        
return $article;

    }


}