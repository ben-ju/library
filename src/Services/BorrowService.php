<?php


namespace App\Services;


use App\Repository\BorrowingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;

class BorrowService extends AbstractController
{
    private SessionService $sessionService;

    /**
     * BorrowService constructor.
     * @param SessionService $sessionService
     */
    public function __construct(SessionService $sessionService)
    {
        $this->sessionService = $sessionService;
    }

    public function getNonReturnedBorrows(UserInterface $user)
    {
        $nonReturnedBorrows = [];
        foreach ($user->getBorrows() as $borrow) {
            if ($borrow->getActualReturnDate() === null) {
                $nonReturnedBorrows[] = $borrow;
            }
        }
        return $nonReturnedBorrows;
    }

    public function addBorrow()
    {
        if (!$this->isGranted('user_blacklisted', $this->getUser())) {
            $this->addFlash('error', "You're blacklisted you can't borrow anymore.");
            return $this->redirectToRoute('home');
        }

//        dd($this->sessionService->getFormattedShoppingCart());

        foreach ($this->sessionService->getFormattedShoppingCart() as $id => $quantity) {
            dump($quantity);
        }
        die();
    }
}