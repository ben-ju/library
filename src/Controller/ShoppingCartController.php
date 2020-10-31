<?php


namespace App\Controller;


use App\Entity\Document;
use App\Services\SessionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShoppingCartController extends AbstractController
{
    private SessionService $sessionService;

    public function __construct(SessionService $service)
    {
        $this->sessionService = $service;
    }

    /**
     * @Route("/cart/add/{id}", name="add_cart")
     * @param Document $document
     * @return RedirectResponse|void
     */
    public function addArticle(Document $document)
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login');
        }
        if ($this->isGranted('document_enough_stock', $document)) {
            if ($this->isGranted('user_borrows', $this->getUser())) {
                $this->sessionService->addDocumentCart($document);
                $this->addFlash('success', "{$document->getTitle()} has been successfully added to your cart !");
            } else {
                $this->addFlash('error', "You have too many borrows pending");
            }
        } else {
            $this->addFlash('error', 'The document is not available');
        }

        return $this->redirectToRoute('full_cart');
    }


    /**
     * @Route("/cart/delete/{id}", name="delete_cart")
     * @param Document $document
     * @return RedirectResponse|void
     */
    public function removeArticle(Document $document)
    {

        $this->sessionService->deleteDocumentCart($document);

        $this->addFlash('success', "{$document->getTitle()} has been successfully removed from your cart !");
        return $this->redirectToRoute('full_cart');
    }

    /**
     * @Route("/cart", name="full_cart")
     * @return Response
     */
    public function fullShoppingCart(): Response
    {
        return $this->render('shopping-cart.html.twig', [
            'cart_items' => $this->sessionService->getFormattedShoppingCart()
        ]);
    }

    public function shortShoppingCart(): Response
    {
        return $this->render('short-shopping-cart.html.twig', [
            'shopping_cart' => $this->sessionService->getFormattedShoppingCart()
        ]);
    }
}