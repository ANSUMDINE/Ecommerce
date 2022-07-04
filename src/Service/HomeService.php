<?php

namespace App\Service;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Traits\ArticleTrait;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\Traits\ArgumentTrait;
use Symfony\Component\HttpFoundation\Request;

class HomeService
{
    use ArticleTrait;
    private $articleRepository;
    private $em;

    public function __construct(
        ArticleRepository $articleRepository,
        EntityManagerInterface $em)
    {
        $this->articleRepository = $articleRepository; 
        $this->em = $em;
    }
    
    public function create(Article $article): void
    {
        $date = date('Y/m/d');
        $article->setCreatedAt(new \DateTimeImmutable($date));
        $this->em->persist($article);
        $this->em->flush();
    }

    public function getArticles(Request $request): array
    {
        $month = $this->getMonth();
        $search = $request->query->get('search');
        
        if($search) {
            return $this->articlesSerializer($this->articleRepository->getArticles($search));
        } else {
            return $this->articlesSerializer($this->articleRepository->findAll());
        }
    }
}
