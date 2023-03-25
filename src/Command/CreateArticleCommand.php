<?php
namespace App\Command;

class CreateArticleCommand
{
    private $title;
    private $description;

    public function __construct($title,$description)
    {
        $this->title = $title;
        $this->description = $description;
    }
    
    public function getTitle():string
    {
        return $this->title;

    }
    public function getDescription():string
    {
        return $this->description;

    }

}
