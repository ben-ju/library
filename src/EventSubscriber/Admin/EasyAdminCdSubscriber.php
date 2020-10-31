<?php


namespace App\EventSubscriber\Admin;


use App\Entity\Cd;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EasyAdminCdSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setCd']
        ];
    }

    public function setCd(BeforeEntityPersistedEvent $e)
    {
        if (!($cd = $e->getEntityInstance()) instanceof Cd) {
            return;
        }
        $cd->setTotalDuration(0);

    }
}