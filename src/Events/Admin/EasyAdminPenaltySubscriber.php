<?php


namespace App\Events\Admin;


use App\Entity\Penalty;
use App\Repository\PenaltyRepository;
use App\Repository\UserRepository;
use Doctrine\Migrations\Configuration\EntityManager\Exception\InvalidConfiguration;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Knp\Component\Pager\Event\BeforeEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EasyAdminPenaltySubscriber implements EventSubscriberInterface
{
    /**
     * @var PenaltyRepository
     */
    private $repository;

    public function __construct(PenaltyRepository $repository)
    {
        $this->repository = $repository;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setPenalty'],
        ];
    }

    public function setPenalty(BeforeEntityPersistedEvent $e)
    {
        if (!($penalty = $e->getEntityInstance()) instanceof Penalty) {
            return;
        }

        $penalties = $penalty->getUser()->getPenalties();
        $penalty->setDate(new \DateTime());

        $countPenalties = count($penalties);

        if ($countPenalties === 0) {
            return $penalty->setType('one_day');
        }

        if ($countPenalties = 1) {
            return $penalty->setType('seven_days');

        }

        if ($countPenalties = 2) {
            return $penalty->setType('fourteen_days');
        }

        return $penalty->setType('blacklisted');
    }
}