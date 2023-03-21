<?php

namespace App\Query\Handler;

use App\Entity\Article;
use App\Query\GetAllArticles;
use Doctrine\Persistence\ManagerRegistry;

class GetAllArticlesHandler

{
  private $registry;

    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }
/**
     * @return Article[]
     */
    public function __invoke(GetAllArticles $query): array
    {
        $repository = $this->registry->getRepository(Article::class);
        return $repository->findAll();
    }

}