<?php

namespace App\Controller;

use App\Query\GetAllArticles;
use App\Query\GetArticleById;
use App\Form\CategoryFilterType;
use App\Query\GetAllCategoriesQuery;
use App\Command\CreateArticleCommand;
use App\Repository\CategoryRepository;
use App\Query\GetArticleByCategoryQuery;
use App\Query\Handler\GetAllArticlesHandler;
use App\Query\Handler\GetArticleByIdHandler;
use App\Command\Handler\CreateArticleHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Query\Handler\GetAllCategoriesQueryHandler;
use App\Query\Handler\GetArticlesByCategoryHandler;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    private $getAllArticlesHandler;
    private $getArticleByIdHandler;
    private $createArticleHandler;
    private $getArticlesByCategoryHandler;
    

    public function __construct(GetAllArticlesHandler $getAllArticlesHandler, GetArticleByIdHandler $getArticleByIdHandler,CreateArticleHandler $createArticleHandler,GetArticlesByCategoryHandler $getArticlesByCategoryHandler)
    {
        $this->getAllArticlesHandler = $getAllArticlesHandler;
        $this->getArticleByIdHandler = $getArticleByIdHandler;
        $this->createArticleHandler = $createArticleHandler;
        $this->getArticlesByCategoryHandler = $getArticlesByCategoryHandler;
    }

    
     #[Route("/articles", name:"article_list")]
public function list(Request $request, GetArticlesByCategoryHandler $handler, GetAllCategoriesQueryHandler $categoriesQueryHandler): Response
{

    $form = $this->createForm(CategoryFilterType::class);

    $form->handleRequest($request);
 
    if ($form->isSubmitted() && $form->isValid()) {
        $category = $form->get('category')->getData();
        $categoryId = $category ? $category->getId() : null;

    } else {
        $categoryId = null;
    }

    if ($categoryId !== null) {
    $query = new GetArticleByCategoryQuery($categoryId);
    $articles = $handler->__invoke($query);
    } else {
        $query = new GetAllArticles();
        $articles = $this->getAllArticlesHandler->__invoke($query);
    }

    $categories = $categoriesQueryHandler->__invoke(new GetAllCategoriesQuery());

    return $this->render('article/list.html.twig', [
        'articles' => $articles,
        'categories' => $categories,
        'form' => $form->createView(),
    ]);
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
