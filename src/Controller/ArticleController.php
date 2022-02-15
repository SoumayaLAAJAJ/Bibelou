<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
     * @Route("/articles/search", name="search-article", methods={ "GET", "POST" })
     */
    public function search(Request $request, ArticleRepository $articleRepository):Response
    {
        $s = $request->request->get("search");
        // dd($s);
        $articles = $articleRepository->search($s);

        return $this->render('article/index.html.twig', [
            "articles" => $articles,
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
