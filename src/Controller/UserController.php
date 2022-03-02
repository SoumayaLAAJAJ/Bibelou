<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Form\UserType;
use App\Entity\Adresse;
use App\Form\AdresseType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    // enregistrement dans la BDD
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager=$entityManager;
    }
    /**
     * @Route("/profile", name="profile")
     */
    public function index(): Response
    {
        $user = $this->getUser();
        return $this->render('user/index.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/edit-profile", name="edit-profile")
     */
    public function editprofile(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, Cart $cart): Response
    {
        
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);
        $adresse = new Adresse();
        $addressForm = $this->createForm(AdresseType::class, $adresse);
        $form->handleRequest($request);
        
        $addressForm->handleRequest($request);
        // pour ajouter adresse :
        if($addressForm->isSubmitted() && $addressForm->isValid()){
            $adresse->setUser($user);
            // dd($adresse);
            $entityManager->persist($adresse);
            $entityManager->flush();
            
            $this->addFlash("success", "Votre adresse a bien été mise à jour. Veuillez sauvegarder les informations complètes");
            
        }
        
        
// pour modifier le mdp
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
        
        return $this->render('user/edit-profile.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
            'addressForm' => $addressForm->createView()
        ]);


    }
    

        









    
    


    


    

}