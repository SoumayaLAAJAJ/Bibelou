<?php

namespace App\Controller;

use App\Repository\CarouselRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/")
     * @Route("/home", name="home")
     */
    public function index(CarouselRepository $carouselRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'carousels' => $carouselRepository->findAll(),
        ]);
    }
}
