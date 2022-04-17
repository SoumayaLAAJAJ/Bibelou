<?php

namespace App\Classe;

use App\Entity\Article;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;




class Cart
{
    private $session;

    public function __construct(EntityManagerInterface $entityManager,SessionInterface $session)
    {
        $this->session = $session;
        $this->entityManager = $entityManager;
    }

    public function add($id){

        $cart = $this->session->get('cart', []);
        
        if(empty($cart[$id])){
            $cart[$id] = 1;
        }
        // $articleInCart = new ArticleInCart();
        // $articleInCart->setArticle($id);
        // $articleInCart->setDate(new DateTime());
        // Puis injecter entityManager dans la méthode add pour pouvoir faire le persist et flush ci dessous


        $this->session->set('cart', $cart);
    }

    public function get()
    {
        return $this->session->get('cart');
    }

    public function remove()
    {
        return $this->session->remove('cart');
    }

    public function delete($id)
    {
        $cart = $this->session->get('cart', []);
        unset($cart[$id]);

        return $this->session->set('cart', $cart);
    }

    public function getFull(){
        $cartComplete = [];
        if($this->get()){
            foreach($this->get() as $id => $quantity){
                $articleObject = $this->entityManager->getRepository(Article::class)->find($id);
                // SECURITE
                if(!$articleObject){
                    $this->delete($id);
                    continue;
                }
                $cartComplete[] = [
                    'article' => $articleObject,
                    'quantity'=> $quantity
                ];
            }
        }
        return $cartComplete;
    }


}