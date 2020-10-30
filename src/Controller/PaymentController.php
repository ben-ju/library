<?php


namespace App\Controller;


use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{

    /**
     * @Route("/subscribe", name="subscribe")
     * @param UserRepository $repository
     * @return Response
     */
    public function subscribe(UserRepository $repository): Response
    {
        if(!$this->isGranted('user_not_subscribed', $this->getUser())) {
            $this->addFlash('error', "You're already subscribed");
            return $this->redirectToRoute('home');
        }
            $repository->subscribeUser($this->getUser());
        return $this->render('payment/success.html.twig');
    }


    /**
     * @Route("/borrows", name="borrow")
     */
    public function borrowBooks()
    {
        $user = $this->getUser();
        $this->denyAccessUnlessGranted('user_blacklisted', $this->getUser());

    }
}