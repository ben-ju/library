<?php


namespace App\Events\Admin;


use App\Entity\Plage;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityDeletedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EasyAdminPlageSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setPlage'],
            BeforeEntityDeletedEvent::class => ['deletePlage']
        ];
    }

    public function setPlage(BeforeEntityPersistedEvent $e)
    {

        if (!($plage = $e->getEntityInstance()) instanceof Plage) {
            return;
        }
        $cd = $plage->getCd();
        $cd->setTotalDuration($cd->getTotalDuration() + $plage->getDuration());
    }

    public function deletePlage(BeforeEntityDeletedEvent $e)
    {
        if (!($plage = $e->getEntityInstance()) instanceof Plage) {
            return;
        }
        $cd = $plage->getCd();
        $cd->setTotalDuration($cd->getTotalDuration() - $plage->getDuration());
    }

}