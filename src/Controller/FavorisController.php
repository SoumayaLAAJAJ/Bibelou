<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FavorisController extends AbstractController
{
    /**
     * @Route("/user/favoris", name="favoris")
     */
    public function index(Request $request, ArticleRepository $articleRepository): Response
    {
        $article = $articleRepository->find($request->request->get("id"));
        $user = $this->getUser();
        return $this->render('favoris/index.html.twig', [
            'article' => $article,
            'user' => $user
        ]);
    }

    // ______________________________________

            // Favoris

    // ______________________________________

    /**
     * @Route("/user/favoris/addarticle", name="addarticle", methods={ "POST", "GET" })
     */
    public function addArticle(Request $request, ArticleRepository $articleRepository, EntityManagerInterface $entityManagerInterface):Response
    {
        $article = $articleRepository->find($request->request->get("id"));
        $user = $this->getUser();
        $user->addArticle($article);

        $entityManagerInterface->persist($user);
        $entityManagerInterface->flush();
        return new Response("ok");
        return $this->render('favoris/index.html.twig', [
            'article' => $article,
            'user' => $user
        ]
        );
    }

        /**
     * @Route("/user/favoris/removearticle/{id}", name="remove-article")
     */
    public function removeArticle(int $id, ArticleRepository $articleRepository, EntityManagerInterface $entityManagerInterface): Response
    {
        $article = $articleRepository->find($id);
        $user = $this->getUser();
        $user->removeArticle($article);
        $entityManagerInterface->persist($user);
        $entityManagerInterface->flush();

        return $this->redirectToRoute('favoris');
    }
}
