<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleFormType;
use App\Service\HomeService;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{   
    private $homeService;
    private $paginator;



    public function __construct(
        PaginatorInterface $paginator,
        HomeService $homeService)
    {
        $this->homeService = $homeService;
        $this->paginator = $paginator;
    }

    
    #[Route('/app_home', name: 'app_home')]
    public function index(Request $request): Response
    {
        $articles = $this->paginator->paginate(
            $this->homeService->getArticles($request),
            $request->query->getInt('page', 1),
            2
        );
        return $this->render('home/index.html.twig', [ 
            'articles' => $articles
        ]);
    }

    #[Route('/create', name: 'create_article')]
    public function create(Request $request): Response
    {
        $article = new Article(); 
        $form = $this->createForm(ArticleFormType::class, $article);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->homeService->create($article);
            return $this->redirectToRoute('app_home');
        }
        return $this->render('home/create.html.twig', [
            'form' => $form->createView()    
        ]);
    }
}
