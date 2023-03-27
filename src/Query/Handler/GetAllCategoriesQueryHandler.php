<?php
namespace App\Query\Handler;

use App\Entity\Category;
use App\Query\GetAllCategoriesQuery;
use Doctrine\ORM\EntityManagerInterface;

class GetAllCategoriesQueryHandler
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(GetAllCategoriesQuery $query): array
    {
        $repository = $this->entityManager->getRepository(Category::class);
        return $repository->findAll();
    }
}