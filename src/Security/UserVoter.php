<?php


namespace App\Security;


use App\Entity\User;
use App\Services\SessionService;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class UserVoter extends Voter
{
    private const USER_NOT_SUBSCRIBED = 'user_not_subscribed';
    private const USER_SUBSCRIBED = 'user_subscribed';
    private const USER_BLACKLISTED = 'user_blacklisted';
    private const USER_BORROWS = 'user_borrows';

    private SessionService $sessionService;

    public function __construct(SessionService $sessionService)
    {
        $this->sessionService = $sessionService;
    }

    protected function supports(string $attribute, $subject)
    {
        if (!in_array($attribute, [self::USER_NOT_SUBSCRIBED, self::USER_SUBSCRIBED, self::USER_BLACKLISTED, self::USER_BORROWS])) {
            return false;
        }

        if (!$subject instanceof User) {
            return false;
        }

        return 'error';
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token)
    {
        switch ($attribute) {
            case self::USER_NOT_SUBSCRIBED:
                return $this->isNotSubscribed($subject);
            case self::USER_SUBSCRIBED:
                return $this->isSubscribed($subject);
            case self::USER_BLACKLISTED:
                return $this->isBlacklisted($subject);
            case self::USER_BORROWS:
                return $this->isMaximumBorrow($subject);
        }
    }

    public function isNotSubscribed(User $subject): bool
    {
        return $subject->getStatus() === 'free';
    }

    public function isSubscribed(User $subject): bool
    {
        return $subject->getStatus() === 'subscribed';
    }

    public function isBlacklisted(User $subject): bool
    {
        $penalties = $subject->getPenalties();
        if (count($penalties) === 0) {
            return true;
        }

        foreach ($penalties as $penalty) {
            if ($penalty->getType() === 'blacklisted') {
                return false;
            }
        }
        return true;
    }

    public function isMaximumBorrow(User $subject): bool
    {
        $nonReturnedBook = $this->sessionService->getTotalQuantity();

        if (count($subject->getBorrows()) !== 0) {
            foreach ($subject->getBorrows() as $borrow) {
                if ($borrow->getActualReturnDate() === null) {
                    ++$nonReturnedBook;
                }
            }
            if ($nonReturnedBook >= 5) {
                return false;
            }
        }
        return true;
    }
}