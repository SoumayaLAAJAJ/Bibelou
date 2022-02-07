<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{

        /**
     * @Route("/article", name="article")
     */
    public function index(ArticleRepository $articleRepository, CategoryRepository $categoryRepository): Response
    {
        // On récupère toutes les catégories
        $articles = $articleRepository->findAll();
        $categories = $categoryRepository->findAll();
        return $this->render('article/index.html.twig', [
            'articles' => $articles,
            'categories' => $categories

        ]);
    }
    


        /**
     * @Route("/article-detail/{id}", name="article-detail")
     */
    public function detail(int $id, ArticleRepository $articleRepository): Response{
        $article = $articleRepository->find($id);
        return $this->render('article/detail.html.twig', [
            "article" => $article,
        ]);
    }
}
