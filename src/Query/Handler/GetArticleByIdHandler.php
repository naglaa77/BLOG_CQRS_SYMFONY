<?php

namespace App\Query\Handler;

use App\Entity\Article;
use App\Query\GetArticleById;
use Doctrine\Persistence\ManagerRegistry;

class GetArticleByIdHandler
{
    private $registry;

    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }

    public function __invoke(GetArticleById $query): ?Article
    {
        $repository = $this->registry->getRepository(Article::class);
        return $repository->find($query->getId());
    }
}
