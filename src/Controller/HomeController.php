<?php

namespace App\Controller;

use Knp\Bundle\PaginatorBundle\KnpPaginatorBundle;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function homepage(): Response
    {
        return $this->render('home/homepage.twig');
    }

//
//    /**
//     * @Route("/books", name="shopping")
//     * @Route("/books/{id}", name="full_book")
//     * @param PaginatorInterface $paginator
//     * @param Request $request
//     * @return Response
//     */
//    public function booksPage PaginatorInterface $paginator, Request $request)
//    {
//        if ($book !== null) {
//            return $this->render('home/__full-book.html.twig', [
//                'book' => $book
//            ]);
//        }
//        $pagination = $paginator->paginate(
//            $repository->getBooksAndStocks(),
//            $request->request->getInt('page', 1),
//            20
//        );
//        $pagination->setCustomParameters([
//            'align' => 'center',
//        ]);
//
//        return $this->render('home/shopping.html.twig', [
//            'pagination' => $pagination,
//            'full_book' => $book
//        ]);
//    }
}
