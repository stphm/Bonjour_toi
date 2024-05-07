<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }

    // /**
    //  * @return User[] Returns an array of User objects
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
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    
/*
    public function findSearch(SearchData $search): array
    {
        $query = $this 
            ->createQueryBuilder('u')
            ->select('ph, u', 'per')
            ->join('u.physical', 'ph')
            ->join('u.personnality', 'per');

            if(!empty($search->q)) {
                $query = $query 
                ->andWhere("u.name LIKE CONCAT('%',:q,'%')")
                ->setParameter('q', $search->q);           
            }
            if(!empty($search->q)) {
                $query = $query 
                ->andWhere("per.movie LIKE CONCAT('%',:q,'%')")
                ->setParameter('q', $search->q);           
            }
            if(!empty($search->q)) {
                $query = $query 
                ->andWhere("per.book LIKE CONCAT('%',:q,'%')")
                ->setParameter('q', $search->q);    
            }
            if(!empty($search->q)) {
                $query = $query 
                ->andWhere("per.favorite_activity LIKE CONCAT('%',:q,'%')")
                ->setParameter('q', $search->q);        
            }
            if(!empty($search->q)) {
                $query = $query 
                ->andWhere('ph.height LIKE :q')
                ->setParameter('q', "%{$search->q}%");           
            }
            if(!empty($search->q)) {
                $query = $query 
                ->andWhere('ph.eyes_color LIKE :q')
                ->setParameter('q', "%{$search->q}%");           
            }
            if(!empty($search->q)) {
                $query = $query 
                ->andWhere('ph.weight LIKE :q')
                ->setParameter('q', "%{$search->q}%");           
            }
            if(!empty($search->q)) {
                $query = $query 
                ->andWhere('ph.hair_color LIKE :q')
                ->setParameter('q', "%{$search->q}%");           
            }

            if (!empty($search->sexe)) {
                $query = $query
                ->andWhere('ph.gender = :sexe')
                ->setParameter('sexe', "%{$search->sexe}%");
            }
        return $query->getQuery()->getResult();
    }

    */


    public function getResultFilter(SearchData $search) 
    {
        $query = $this->createQueryBuilder('u')
        ->addSelect('physical')
        ->addSelect('personnality')
        ->innerJoin('u.physical', 'physical')
        ->innerJoin('u.personnality', 'personnality');    
        // dd(!empty($search->q)); 
        if (!empty($search->q)) {
           $query = $query 
           ->andWhere("personnality.music LIKE CONCAT('%', :q, '%')")
           ->setParameter('q', $search->q);
       }
    //  dd(!empty($search->sexe)); 
       if(!empty($search->sexe)) {
        $query = $query
        ->andWhere('physical.gender = :sexe' )
        ->setParameter('sexe', $search->sexe);
    }
        
        
    return $query->getQuery()->getResult();
    }

}
