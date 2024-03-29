<?php

namespace App\Controller;

use DateTime;
use App\Classe\Cart;
use App\Entity\Order;
use DateTimeImmutable;
use App\Form\OrderType;
use App\Entity\OrderDetails;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/commande", name="order")
     */
    public function index(Cart $cart, Request $request): Response
    {

        $form = $this->createForm(OrderType::class, null, ['user'=>$this->getUser()]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            dd($form->getData());
        }

        return $this->render('order/index.html.twig', [
            'form' => $form->createView(),
            'cart'=> $cart->getFull()
        ]);
    }

    /**
     * @Route("/commande/recapitulatif", name="order_recap")
     */
    public function add(Cart $cart, Request $request): Response
    {

        $form = $this->createForm(OrderType::class, null, ['user'=>$this->getUser()]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $date = new DateTimeImmutable();
            $carriers = $form->get('carriers')->getData();
            $delivery = $form->get('addresses')->getData();
            $delivery_content = $delivery->getName().'<br>'.$delivery->getLastname();
            $delivery_content .= '<br>'.$delivery->getPhone();
            if($delivery->getCompany()){
                $delivery_content .= '<br>'.$delivery->getCompany();
            }
            $delivery_content .= '<br>'.$delivery->getAddress();
            $delivery_content .= '<br>'.$delivery->getZipcode().' '.$delivery->getCity();
            $delivery_content .= '<br>'.$delivery->getCountry();

            
            
            // Enregistrer ma commande via Order()
            $order = new Order();
            $reference = $date->format('dmY').'-'.uniqid();

            $order->setReference($reference);
            $order->setUser($this->getUser());
            $order->setCreatedAt($date);
            $order->setCarrierName($carriers->getName());
            $order->setCarrierPrice($carriers->getPrice());
            $order->setDelivery($delivery_content);
            $order->setIsPaid(0);

            $this->entityManager->persist($order);
            


            

            // Enregistrer mes produits via OrderDetails()
            foreach ($cart->getFull() as $article){
                $orderDetails = new OrderDetails();
                $orderDetails->setMyOrder($order);
                $orderDetails->setArticle($article['article']->getName());
                $orderDetails->setQuantity($article['quantity']);
                $orderDetails->setPrice($article['article']->getPrice());
                $orderDetails->setTotal($article['article']->getPrice() * $article['quantity']);
                // dd($article['quantity']);
                $this->entityManager->persist($orderDetails);

                
            }

            // dd($order);


            $this->entityManager->flush();

            
            


            return $this->render('order/add.html.twig', [
                'cart'=> $cart->getFull(),
                'carrier'=> $carriers,
                'delivery'=> $delivery_content,
                'reference'=>$order->getReference(),
                
            ]);

        
        }

        return $this->redirectToRoute('cart');
    }
}
