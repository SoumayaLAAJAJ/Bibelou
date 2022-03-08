<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderSuccessController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/commande/merci/{stripeSessionId}", name="order_validate")
     */
    public function index($stripeSessionId, Cart $cart): Response
    {

        $order = $this->entityManager->getRepository(Order::class)->findOneByStripeSessionId($stripeSessionId);

        if(!$order || $order->getUser() != $this->getUser()){
            return $this->redirectToRoute('home');
        }

        if(!$order->getIsPaid()){
            // Vider la session "cart"
            $cart->remove();
            // Modification du statut isPaid de la commande en passant le statut à 1
            $order->setIsPaid(1);
            $this->entityManager->flush();
            // Envoyer un email au client pour lui confirmer sa commande

        }




        // Afficher les quelques infos de la commande du user


        // dd($order);

        return $this->render('order_success/index.html.twig', [
            'order' => $order
        ]);
    }
}
