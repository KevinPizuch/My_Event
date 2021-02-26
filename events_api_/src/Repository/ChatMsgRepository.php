<?php

namespace App\Repository;

use App\Entity\ChatMsg;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ChatMsg|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChatMsg|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChatMsg[]    findAll()
 * @method ChatMsg[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChatMsgRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChatMsg::class);
    }

    // /**
    //  * @return ChatMsg[] Returns an array of ChatMsg objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ChatMsg
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
