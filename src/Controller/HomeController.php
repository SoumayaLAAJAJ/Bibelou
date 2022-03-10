<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\Article;
use App\Repository\CarouselRepository;
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
    public function index(CarouselRepository $carouselRepository): Response
    {
        // $mail = new Mail();
        // $mail->send('boutique.bibelou@gmail.com', 'Soum Ljj', 'Mail test', 'Bonjour - test');

        $articles = $this->entityManager->getRepository(Article::class)->findByIsActu(1);
        // dd($articles);


        return $this->render('home/index.html.twig', [
            'carousels' => $carouselRepository->findAll(),
            'articles' =>$articles,
        ]);

    }
}
