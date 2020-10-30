<?php


namespace App\Events\Admin;


use App\Entity\Borrowing;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityDeletedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EasyAdminBorrowingSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setBorrowing'],
        ];
    }

    public function setBorrowing(BeforeEntityPersistedEvent $e)
    {

        if (!($borrowing = $e->getEntityInstance()) instanceof Borrowing) {
            return;
        }

        $returnDate = clone $borrowing->getBorrowedAt();

        $borrowing->setExpectedReturnDate($returnDate->modify('+1 month'));
        $user = $borrowing->getUser();
        $document = $borrowing->getDocument();
        $nonReturnedBook = 0;

        if ($user->getStatus() === 'free') {
            throw new \Error('This user is not subscribed, he can\'t borrow');
        }

        if ($document->getStock() > 0) {
            foreach ($user->getBorrows() as $borrow) {
                if ($borrow->getActualReturnDate() === null) {
                    ++$nonReturnedBook;
                }
            }
            if ($nonReturnedBook < 5) {
                $document->setStock($document->getStock() - 1);
                $user->addBorrow($borrowing);
            } else {
                throw new \Error('The user can\'t borrow more than 5 books');
            }
        } else {
            throw new \Error('This book is not available');
        }
    }
}