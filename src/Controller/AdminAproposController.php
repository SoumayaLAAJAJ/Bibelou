<?php

namespace App\Controller;

use App\Entity\Apropos;
use App\Form\AproposType;
use App\Repository\AproposRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/apropos")
 */
class AdminAproposController extends AbstractController
{
    /**
     * @Route("/", name="admin_apropos_index", methods={"GET"})
     */
    public function index(AproposRepository $aproposRepository): Response
    {
        return $this->render('admin_apropos/index.html.twig', [
            'apropos' => $aproposRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_apropos_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $apropo = new Apropos();
        $form = $this->createForm(AproposType::class, $apropo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($apropo);
            $entityManager->flush();

            return $this->redirectToRoute('admin_apropos_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_apropos/new.html.twig', [
            'apropo' => $apropo,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_apropos_show", methods={"GET"})
     */
    public function show(Apropos $apropo): Response
    {
        return $this->render('admin_apropos/show.html.twig', [
            'apropo' => $apropo,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_apropos_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Apropos $apropo, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AproposType::class, $apropo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_apropos_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_apropos/edit.html.twig', [
            'apropo' => $apropo,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_apropos_delete", methods={"POST"})
     */
    public function delete(Request $request, Apropos $apropo, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$apropo->getId(), $request->request->get('_token'))) {
            $entityManager->remove($apropo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_apropos_index', [], Response::HTTP_SEE_OTHER);
    }
}
