<?php


namespace App\Controller\Manager;


use App\Entity\User;
use App\Event\RegistrationEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class RegistrationManager
{

    private EventDispatcherInterface $eventDispatcher;

    /**
     * RegistrationManager constructor.
     * @param $eventDispatcher
     */
    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function sendRegistrationMail(User $user)
    {

        $event = new RegistrationEvent($user);
        $this->eventDispatcher->dispatch($event);
    }

}