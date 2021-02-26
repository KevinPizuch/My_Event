<?php

namespace App\Repository;

use App\Entity\EventGrp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EventGrp|null find($id, $lockMode = null, $lockVersion = null)
 * @method EventGrp|null findOneBy(array $criteria, array $orderBy = null)
 * @method EventGrp[]    findAll()
 * @method EventGrp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventGrpRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EventGrp::class);
    }

    // /**
    //  * @return EventGrp[] Returns an array of EventGrp objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EventGrp
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
