<?php

namespace App\Repository;

use App\Entity\Author;
use App\Entity\Document;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Doctrine\Persistence\ManagerRegistry;
use function Doctrine\ORM\QueryBuilder;

/**
 * @method Document|null find($id, $lockMode = null, $lockVersion = null)
 * @method Document|null findOneBy(array $criteria, array $orderBy = null)
 * @method Document[]    findAll()
 * @method Document[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocumentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Document::class);
    }

    public function getDocumentsAndStocks($id)
    {
        $qb = $this->createQueryBuilder('d');
        $qb->select('d.reference_number')
            ->where('d.id = :id')
            ->setParameter('id', $id);

        return $qb->getQuery()->getResult();
    }

    public function searchByTitle($search)
    {

        $qb = $this->createQueryBuilder('d');
            $qb->where($qb->expr()->like('d.title', ':search'))
                ->orderBy('d.published_at', 'DESC')
                ->setParameter('search', "%{$search}%");

            return $qb->getQuery()->getResult();

    }

    public function searchByCategory()
    {
//        $qb = $this->createQueryBuilder('d');
//
//        $qb->where($qb->expr()->like('d.type', 'book'))
//            ->join()
    }


    /*
    public function findOneBySomeField($value): ?Document
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
