<?php

namespace App\Repository;

use App\Entity\Personnality;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Personnality|null find($id, $lockMode = null, $lockVersion = null)
 * @method Personnality|null findOneBy(array $criteria, array $orderBy = null)
 * @method Personnality[]    findAll()
 * @method Personnality[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonnalityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Personnality::class);
    }

    // /**
    //  * @return Personnality[] Returns an array of Personnality objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Personnality
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
