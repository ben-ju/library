<?php


namespace App\Controller;


use App\Services\BorrowService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    /**
     * @Route("/profile", name="profile")
     * @param BorrowService $service
     * @return Response
     */
    public function userProfile(BorrowService $service): Response
    {

        return $this->render('user/__profile.html.twig', [
            'nonReturnedBorrows' => $service->getNonReturnedBorrows($this->getUser()),
        ]);
    }
}