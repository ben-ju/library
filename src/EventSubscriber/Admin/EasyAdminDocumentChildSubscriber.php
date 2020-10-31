<?php


namespace App\EventSubscriber\Admin;


use App\Entity\Cd;
use App\Entity\Dvd;
use App\Entity\Novel;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EasyAdminDocumentChildSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setChildDocumentEntities']
        ];
    }

    public function setChildDocumentEntities(BeforeEntityPersistedEvent $e)
    {
        $entity = $e->getEntityInstance();
        if (!($entity instanceof Cd || $entity instanceof Dvd || $entity instanceof Novel)) {
            return;
        }
        $entity->setReferenceNumber(uniqid('', true));

    }
}