<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/cart", name="cart")
     */
    public function index(Cart $cart): Response
    {
        
        return $this->render('cart/index.html.twig', [
            'cart' => $cart->getFull()
        ]);
    }


    /**
     * @Route("/cart/add/{id}", name="add-to-cart")
     */
    public function addToCart(Cart $cart, $id): Response
    {
        $cart->add($id);
        // dd($id);
        return $this->redirectToRoute('cart');
    }
    
    /**
     * @Route("/cart/remove", name="remove-cart")
     */
    public function RemoveCart(Cart $cart): Response
    {
        $cart->remove();
        // dd($id);
        return $this->redirectToRoute('article');
    }

        /**
     * @Route("/cart/delete/{id}", name="delete-item")
     */
    public function delete(Cart $cart, $id): Response
    {
        $cart->delete($id);
        return $this->redirectToRoute('cart');
    }
}
