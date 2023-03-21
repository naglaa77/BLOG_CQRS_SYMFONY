<?php

// src/Controller/ArticleController.php

namespace App\Controller;

use App\Query\GetAllArticles;
use App\Query\Handler\GetAllArticlesHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    private $getAllArticlesHandler;

    public function __construct(GetAllArticlesHandler $getAllArticlesHandler)
    {
        $this->getAllArticlesHandler = $getAllArticlesHandler;
    }

    /**
     * @Route("/articles", name="article_list")
     */
    public function list(): Response
    {
        $query = new GetAllArticles();
        $articles = $this->getAllArticlesHandler->__invoke($query);

        return $this->render('article/list.html.twig', ['articles' => $articles]);
    }
}
