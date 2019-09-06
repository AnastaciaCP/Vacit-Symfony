<?php 

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use FOS\UserBundle\Model\UserManagerInterface;

use App\Entity\Jobs;
use App\Repository\JobsRepository;

class JobsService 
{
    private $em;
    private $um;

    protected $rep;


    public function __construct(EntityManagerInterface $em,
                                UserManagerInterface $um)
    {
        $this->em = $em;
        $this->um = $um;
        $this->rep = $this->em->getRepository(Jobs::class);
    }

    /*
     * Find job offer with specific ID
     */
    public function find($id) {
        return $this->rep->find($id);
    }

    /*
     * Finds all jobs in database
     */
    public function findAllJobs() {
        return $this->rep->findAllJobs();
    }

    /*
     * Finds all jobs from particular user
     */
    public function findAllfromUser($user) {
        return $this->rep->findAllfromUser($user);
    }

    /*
     * Find the five most recent jobs
     */
    public function findRecentFive() {
        return $this->rep->findRecentFive();
    }

    /*
     * Finds all jobs of employer except the one already displayed
     */
    public function findDifferentJobs($jobs) {
        return $this->rep->findDifferentJobs($jobs);
    }






}