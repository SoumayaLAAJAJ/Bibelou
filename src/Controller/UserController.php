<?php

namespace App\Controller;

use App\Form\UserType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function index(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $plainPassword = $form->get("plainPassword")->getData();
            if(!is_null($plainPassword)){

            
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user, 
                    $plainPassword
                )
            );
            }

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash("success", "Vos informations ont bien été mises à jour");
            $this->redirectToRoute("profile");
        }

        return $this->render('user/index.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/addarticle", name="addarticle", methods={ "POST", "GET" })
     */
    public function addArticle(Request $request, ArticleRepository $articleRepository, EntityManagerInterface $entityManagerInterface):Response
    {
        $article = $articleRepository->find($request->request->get("id"));
        $user = $this->getUser();
        $user->addArticle($article);

        $entityManagerInterface->persist($user);
        $entityManagerInterface->flush();
        return new Response("ok");
    }

        /**
     * @Route("/user/removearticle/{id}", name="remove-article")
     */
    public function removeBook(int $id, ArticleRepository $articleRepository, EntityManagerInterface $entityManagerInterface): Response
    {
        $article = $articleRepository->find($id);
        $user = $this->getUser();
        $user->removeArticle($article);
        $entityManagerInterface->persist($user);
        $entityManagerInterface->flush();

        return $this->redirectToRoute('profile');
    }
}
