<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use App\Service\JobsService;

class JobsController extends AbstractController
{


    private $js;
     
    public function __construct(JobsService $js) {
        $this->js = $js;
    }

    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function index()
    {
        $jobs = $this->js->findRecentFive();
        return ['jobs'=> $jobs];
    }

    /**
     * @Route("/job/{id}", name="job")
     * @Template()
     */
    public function findJob($id)
    {
        $job = $this->js->find($id);
        $difjob = $this->js->findDifferentJobs($job);
        return ['jobs' => $job,
                'difjobs' => $difjob];
    }


    /**
     * @Route("/jobs", name="jobs")
     * @Template()
     */

    public function findAllJobs()
    {
        $jobs = $this->js->findAllJobs();
        return ['jobs' => $jobs];
    }

    /**
     * @Route("/my-jobs", name="my_jobs")
     * @Template()
     */
    public function myJobs()
    {
        $user = $this->getUser();
        $jobs = $user->getJobs();
        return ['jobs' => $jobs];
    }





}
