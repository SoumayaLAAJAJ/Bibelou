<?php

namespace App\Controller;
    
use App\Classe\Cart;
use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
    
class StripeController extends AbstractController
{
    /**
     * @Route("/commande/create-session/{reference}", name="stripe_create_session")
    */
        public function index(EntityManagerInterface $entityManager,Cart $cart, $reference)
        {
            $article_for_stripe = [];
            $YOUR_DOMAIN = 'http://127.0.0.1:8000';

            $order = $entityManager->getRepository(Order::class)->findOneBy(['reference' => $reference]);

            // if (!$order) {
            //     $this->redirectToRoute('order');
            // }

            // dd($order);
            foreach ($cart->getFull() as $article){
                // $article = $entityManager->getRepository(Article::class)->findOneBy(['name' => $article->getArticle()]);
                $article_for_stripe[] = [
                    'price_data' => [
                        'currency' => 'EUR',
                        'unit_amount' => $article['article']->getPrice()*100,
                        'product_data' => [
                            'name' => $article['article']->getName(),
                        ],
                    ],
                    'quantity' => $article['quantity']
                ];
            }
            // $article_for_stripe[] = [
            //         'price_data' => [
            //             'currency' => 'eur',
            //             'unit_amount' => $order->getCarrierPrice() * 100,
            //             'article_data' => [
            //                 'name' => $order['order']->getCarrierName(),

            //             ],
            //         ],
            //         'quantity' => 1,
            //     ];

            Stripe::setApiKey('sk_test_51KQYaXFdneTbx5IuRyjpuFaB4fUjiPDINfx4Y0dzU9VXVu8VcPlGwuE04QWT59e4YGBQujSuAGnmw81XBs58Q2o400KYKivpX2');

            
            
            $checkout_session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    $article_for_stripe
                ],
                    'mode' => 'payment',
                    'success_url' => $YOUR_DOMAIN .'/success.html',
                    'cancel_url' => $YOUR_DOMAIN .'/cancel.html',

            ]);


    
            return $this->redirect($checkout_session->url);
        }
    }
