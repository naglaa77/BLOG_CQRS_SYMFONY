<?php

namespace App\Query;

class GetArticleByCategoryQuery
{
    private ?int $categoryId;

    public function __construct(?int $categoryId = null)
    {
        $this->categoryId = $categoryId;
    }

    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }
}

