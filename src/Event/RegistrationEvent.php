<?php


namespace App\Event;


use App\Entity\User;
use Symfony\Contracts\EventDispatcher\Event;

class RegistrationEvent extends Event
{
    public const TEMPLATE_REGISTRATION = 'email/template.html.twig';

    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}