<?php

namespace App\Repository;

use App\Entity\Jobs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Jobs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Jobs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Jobs[]    findAll()
 * @method Jobs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Jobs::class);
    }


    /*
     * returns an array of all Jobs objects
     * Array is ordered date in descending manner (most recent on top)
     */
    public function findAllJobs() 
    {
        return $this->createQueryBuilder('j')
        ->orderBy('j.date', 'DESC')
        ->getQuery()
        ->getResult()
        ;

    }

    /*
     * Finds 5 most recent job offers
     */
    public function findRecentFive()
    {
        return $this->createQueryBuilder('j')
        ->orderBy('j.date', 'DESC')
        ->setMaxResults(5)
        ->getQuery()
        ->getResult()
    ;   
    }

    /* 
     * Finds all job offers from one employer 
     */
    public function findAllfromUser($user) 
    {
        return $this->createQueryBuilder('j')
        ->andWhere('j.user = :val')
        ->setParameter('val', $user->getId())
        ->orderBy('j.date', 'DESC')
        ->getQuery()
        ->getResult()
    ;
    }

    /*
     * Finds job offers from employer except for the one already displayed.
     */
    public function findDifferentJobs($jobs)
    {
        return $this->createQueryBuilder('j')
        ->andWhere('j.user = :val')
        ->setParameter('val', $jobs->getUser())
        ->andWhere('j.id != :current')
        ->setParameter('current', $jobs->getId())
        ->orderBy('j.date', 'DESC')
        ->getQuery()
        ->getResult()
    ;
    }

    public function getApplications($job)
    {
        $job->getApplications();
        return $job;
    }

    

    

    // /**
    //  * @return Jobs[] Returns an array of Jobs objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Jobs
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
