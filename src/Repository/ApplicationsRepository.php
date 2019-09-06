<?php

namespace App\Repository;

use App\Entity\Applications;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Applications|null find($id, $lockMode = null, $lockVersion = null)
 * @method Applications|null findOneBy(array $criteria, array $orderBy = null)
 * @method Applications[]    findAll()
 * @method Applications[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApplicationsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Applications::class);
    }


    /*
     * First checks if given $user has applied to given $job before. 
     * If yes, returns empty in controller.
     * If not found, creates new Application.
     */
    public function applyforJob($user, $job)
    {   
        $found = $this->findBy(['candidate' => $user,
                                'jobs' => $job]);

        if ($found) {
            return;
        } else {
            $application = new Applications;
            $application->setDateApplication(new \DateTime);
            $application->setJobs($job);
            $application->setCandidate($user);

            $em = $this->getEntityManager();
            $em->persist($application);
            $em->flush();

            return($application);
        }
       
    }

    /*
     * Given $application id, sets Invitation variable to true. 
     * Returns an updated Application object
     */
    public function inviteCandidate($application) 
    {
        $application->setInvitation(true);

        $em = $this->getEntityManager();
        $em->persist($application);
        $em->flush();

        return($application);
    }
    


    
    // /**
    //  * @return Applications[] Returns an array of Applications objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Applications
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
