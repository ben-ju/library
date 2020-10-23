<?php


namespace App\Controller;


use App\Repository\NovelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class ShoppingCartController extends AbstractController
{
    /**
     * @Route("/cart/{id}", name="cart")
     * @param Request $request
     */
    public function addArticle(Request $request): void
    {
        $session = $request->getSession();

        $session->get('cart', []);

        $session->set('cart', ['hello']);

        dd($session->get('cart'));


    }
}