<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\Article;
use App\Entity\SecondCarousel;
use App\Repository\CarouselRepository;
use App\Repository\CategoryRepository;
use App\Repository\SecondCarouselRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/")
     * @Route("/home", name="home")
     */
    public function index(CarouselRepository $carouselRepository, SecondCarouselRepository $secondCarouselRepository): Response
    {


        $articles = $this->entityManager->getRepository(Article::class)->findByIsActu(1);

        $articlesAll = $this->entityManager->getRepository(Article::class)->findAll();
        // dd($articles);


        return $this->render('home/index.html.twig', [
            'carousels' => $carouselRepository->findAll(),
            'secondCarousels' => $secondCarouselRepository->findAll(),
            'articles' =>$articles,
            'articlesAll' => $articlesAll
        ]);

    }
}
