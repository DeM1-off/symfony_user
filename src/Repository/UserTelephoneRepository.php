<?php

namespace App\Repository;

use App\Entity\UserTelephone;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserTelephone|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserTelephone|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserTelephone[]    findAll()
 * @method UserTelephone[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserTelephoneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserTelephone::class);
    }

    // /**
    //  * @return UserTelephone[] Returns an array of UserTelephone objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserTelephone
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
