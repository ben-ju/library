<?php


namespace App\Services;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;

class BorrowService extends AbstractController
{
    public function getNonReturnedBorrows(UserInterface $user)
    {
        $nonReturnedBorrows = [];
        foreach ($user->getBorrows() as $borrow) {
            if($borrow->getActualReturnDate() === null) {
                $nonReturnedBorrows[] = $borrow;
            }
        }
        return $nonReturnedBorrows;
    }
}