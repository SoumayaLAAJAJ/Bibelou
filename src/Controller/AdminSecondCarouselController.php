<?php

namespace App\Controller;

use App\Entity\SecondCarousel;
use App\Form\SecondCarouselType;
use App\Repository\SecondCarouselRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/second/carousel")
 */
class AdminSecondCarouselController extends AbstractController
{
    /**
     * @Route("/", name="admin_second_carousel_index", methods={"GET"})
     */
    public function index(SecondCarouselRepository $secondCarouselRepository): Response
    {
        return $this->render('admin_second_carousel/index.html.twig', [
            'second_carousels' => $secondCarouselRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_second_carousel_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $secondCarousel = new SecondCarousel();
        $form = $this->createForm(SecondCarouselType::class, $secondCarousel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($secondCarousel);
            $entityManager->flush();

            return $this->redirectToRoute('admin_second_carousel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_second_carousel/new.html.twig', [
            'second_carousel' => $secondCarousel,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_second_carousel_show", methods={"GET"})
     */
    public function show(SecondCarousel $secondCarousel): Response
    {
        return $this->render('admin_second_carousel/show.html.twig', [
            'second_carousel' => $secondCarousel,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_second_carousel_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, SecondCarousel $secondCarousel, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SecondCarouselType::class, $secondCarousel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_second_carousel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_second_carousel/edit.html.twig', [
            'second_carousel' => $secondCarousel,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_second_carousel_delete", methods={"POST"})
     */
    public function delete(Request $request, SecondCarousel $secondCarousel, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$secondCarousel->getId(), $request->request->get('_token'))) {
            $entityManager->remove($secondCarousel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_second_carousel_index', [], Response::HTTP_SEE_OTHER);
    }
}
