<?php

namespace App\Controller;

use App\Entity\Apropos;
use App\Repository\AproposRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AproposController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/apropos", name="apropos")
     */
    public function index(AproposRepository $aproposRepository): Response
    {
        // $section = $this->entityManager->getRepository(Apropos::class)->findAll();
        return $this->render('apropos/index.html.twig', [
            'apropos' => $aproposRepository->findAll(),
        ]);
    }
}
