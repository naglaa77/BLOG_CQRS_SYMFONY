<?php

namespace App\Controller;

use App\Query\GetAllArticles;
use App\Query\GetArticleById;
use App\Query\Handler\GetAllArticlesHandler;
use App\Query\Handler\GetArticleByIdHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    private $getAllArticlesHandler;
    private $getArticleByIdHandler;

    public function __construct(GetAllArticlesHandler $getAllArticlesHandler, GetArticleByIdHandler $getArticleByIdHandler)
    {
        $this->getAllArticlesHandler = $getAllArticlesHandler;
        $this->getArticleByIdHandler = $getArticleByIdHandler;
    }

    
     #[Route("/articles", name:"article_list")]
     
    public function list(): Response
    {
        $query = new GetAllArticles();
        $articles = $this->getAllArticlesHandler->__invoke($query);

        return $this->render('article/list.html.twig', ['articles' => $articles]);
    }

    
     #[Route("/article/{id}", name:"article_show")]
    public function show(int $id): Response
    {
        $query = new GetArticleById($id);
        $article = $this->getArticleByIdHandler->__invoke($query);

        if (!$article) {
            throw $this->createNotFoundException('The article does not exist.');
        }

        return $this->render('article/show.html.twig', ['article' => $article]);
    }
}
