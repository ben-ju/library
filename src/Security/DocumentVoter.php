<?php


namespace App\Security;


use App\Entity\Document;
use App\Services\SessionService;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class DocumentVoter extends Voter
{

    private SessionService $sessionService;


    private const DOCUMENT_ENOUGH_STOCK = 'document_enough_stock';

    /**
     * DocumentVoter constructor.
     * @param SessionService $sessionService
     */
    public function __construct(SessionService $sessionService)
    {
        $this->sessionService = $sessionService;
    }

    /**
     * @param string $attribute
     * @param mixed $subject
     * @return bool
     */
    protected function supports(string $attribute, $subject)
    {
        if (!in_array($attribute, [self::DOCUMENT_ENOUGH_STOCK])) {
            return false;
        }

        if (!$subject instanceof Document) {
            return false;
        }

        return true;
    }

    /**
     * @param string $attribute
     * @param mixed $subject
     * @param TokenInterface $token
     * @return bool|string
     */
    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token)
    {
        if (!$subject instanceof Document) {
            return false;
        }

        switch ($attribute) {
            case self::DOCUMENT_ENOUGH_STOCK:
                return $this->isStockAvailable($subject);
        }
        return 'error';
    }


    public function isStockAvailable(Document $subject): ?bool
    {
        foreach ($this->sessionService->getShoppingCart() as $key => $quantity) {
            if ($subject->getId() === $key) {
                return !($subject->getStock() === $quantity);
            }
        }
        return true;
    }
}