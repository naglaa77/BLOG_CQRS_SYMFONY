<?php

namespace App\Query\Handler;

use App\Entity\Article;
use App\Query\GetArticleByCategoryQuery;
use Doctrine\Persistence\ManagerRegistry;

class GetArticlesByCategoryHandler
{
    private $registry;

    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }

    public function __invoke(GetArticleByCategoryQuery $query): array
    {
        $repository = $this->registry->getRepository(Article::class);
        if($query->getCategoryId() !== null) {
            return $repository->findBy(['category' => $query->getCategoryId()]);

        }
        return  $repository->findAll();

    }
}
