<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
        /**
     * @Route("/category", name="category")
     */
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }


            /**
     * @Route("/category-detail/{id}", name="category-detail")
     */
    public function detail(int $id, CategoryRepository $categoryRepository): Response{
        $categories = $categoryRepository->findAll();
        $category = $categoryRepository->find($id);

        return $this->render('category/detail.html.twig', [
            'categories' => $categories,
            'category' => $category
        ]);
    }
}