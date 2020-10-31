<?php


namespace App\EventSubscriber;


use App\Event\RegistrationEvent;
use Swift_Mailer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class RegistrationSubscriber implements EventSubscriberInterface
{

    private Swift_Mailer $swiftMailer;

    public function __construct(Swift_Mailer $mailer)
    {
        $this->swiftMailer = $mailer;
    }

    public static function getSubscribedEvents()
    {
        return [
            RegistrationEvent::class => 'onRegistration'
        ];
    }

    public function onRegistration(RegistrationEvent $event)
    {
        $user = $event->getUser();

        $message = new \Swift_Message('hello');

        $message->setFrom('grenoble-library@gmail.com')
            ->setTo($user->getEmail())
            ->setBody($event::TEMPLATE_REGISTRATION);

        $this->swiftMailer->send($message);
    }

}