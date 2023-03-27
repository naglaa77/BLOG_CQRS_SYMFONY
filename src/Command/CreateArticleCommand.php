<?php
namespace App\Command;

class CreateArticleCommand
{
    private $title;
    private $description;
    private $categoryId;


    public function __construct($title,$description,$categoryId)
    {
        $this->title = $title;
        $this->description = $description;
        $this->categoryId = $categoryId;
    }
    
    public function getTitle():string
    {
        return $this->title;

    }
    public function getDescription():string
    {
        return $this->description;

    }
    public function getCategoryId(): ?string
    {
        return $this->categoryId;
    }

}
