<?php

namespace App\Controller;

use App\Command\CreateArticleCommand;
use App\Command\Handler\CreateArticleHandler;
use Symfony\Component\HttpFoundation\Request;
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

    public function __construct(GetAllArticlesHandler $getAllArticlesHandler, GetArticleByIdHandler $getArticleByIdHandler,CreateArticleHandler $createArticleHandler)
    {
        $this->getAllArticlesHandler = $getAllArticlesHandler;
        $this->getArticleByIdHandler = $getArticleByIdHandler;
        $this->createArticleHandler = $createArticleHandler;
    }

    
     #[Route("/articles", name:"article_list")]
     
    public function list(): Response
    {
        $query = new GetAllArticles();
        $articles = $this->getAllArticlesHandler->__invoke($query);

        return $this->render('article/list.html.twig', ['articles' => $articles]);
    }

    
     #[Route("/article/{id<\d+>}", name:"article_show")]
    public function show(int $id): Response
    {
        $query = new GetArticleById($id);
        $article = $this->getArticleByIdHandler->__invoke($query);

        if (!$article) {
            throw $this->createNotFoundException('The article does not exist.');
        }

        return $this->render('article/show.html.twig', ['article' => $article]);
    }

     #[Route("/article/create", name:"article_create",methods:["GET", "POST"])]
    public function create(Request $request): Response
    {
       
        if ($request->IsMethod('POST')) {
            $title = $request->request->get('title');
            $description = $request->request->get('description');
            
            $command = new CreateArticleCommand($title,$description);
            $this->createArticleHandler->__invoke($command);

            return $this->redirectToRoute('article_list');
        
        }

        return $this->render('article/create.html.twig');
    }
}
