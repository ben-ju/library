<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function subscribeUser(UserInterface $user)
    {
        $query = $this->_em->createQueryBuilder();
            return $query->update(User::class, 'u')
                ->set('u.subscribed_at', '?1')
                ->setParameter(1, date('Y-m-d'))
                ->set('u.status', '?2')
                ->setParameter(2, 'subscribed')
                ->set('u.subscription_end_date', '?3')
                ->setParameter(3, date('Y-m-d', strtotime('+1 year')))
                ->where('u.id = ?4')
                ->setParameter(4, $user->getId())
                ->getQuery()
                ->getResult();
    }
}
