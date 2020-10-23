<?php

namespace App\Repository;

use App\Entity\Novel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Novel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Novel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Novel[]    findAll()
 * @method Novel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NovelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Novel::class);
    }

    public function getAverageBookPages()
    {
        $qb = $this->createQueryBuilder('n');
                return $qb->select($qb->expr()->avg('n.pages'))
                    ->getQuery()->getResult();
    }

    public function booksBiggerThanAverage()
    {
        $qb = $this->createQueryBuilder('n');
        $avg = $qb->select($qb->expr()->avg('n.pages'))
            ->getDQL();

//        $qb = $this->createQueryBuilder('n')
//            ->
    }


}
