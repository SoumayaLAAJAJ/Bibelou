<?php

namespace App\Controller;

use App\Entity\Order;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MesCommandesController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/user/mes-commandes", name="mes_commandes")
     */
    public function index(): Response
    {
        $orders = $this->entityManager->getRepository(Order::class)->findSuccessOrders($this->getUser());

        // dd($orders);
        return $this->render('mes_commandes/index.html.twig', [
            'orders' => $orders,
        ]);
    }

    /**
     * @Route("/user/mes-commandes/{reference}", name="detail_commande")
     */
    public function detail($reference): Response
    {
        $order = $this->entityManager->getRepository(Order::class)->findOneByReference($reference);

        if(!$order || $order->getUser() != $this->getUser()){
            return $this->redirectToRoute("mes_commandes");
        }

        // dd($orders);
        return $this->render('mes_commandes/detail.html.twig', [
            'order' => $order,
        ]);
    }
}
