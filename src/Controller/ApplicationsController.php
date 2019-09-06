<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Service\JobsService;
use App\Service\ApplicationsService;

class ApplicationsController extends AbstractController
{

    private $js;

    public function __construct(JobsService $js,
                                ApplicationsService $as) {
        $this->js = $js;
        $this->as = $as;
    }

    /**
     * @Route("my-applications", name="my_applications")
     * @Template()
     */
    public function myApplications()
    {
        $user = $this->getUser();
        $applications = $user->getApplications();
        return ['applications' => $applications];
    }

    /**
     * @Route("job-applications/{id}", name="job_applications")
     * @Template()
     */
    public function jobApplications($id)
    {
        $job = $this->js->find($id);
        $applications = $job->getApplications();
        return ['job' => $job, 
                'applications' => $applications];
    }

    /**
     * @Route("apply", name="apply")
     * @Template()
     */
    public function apply(Request $request)
    {
        $user = $this->getUser();
        $id = $request->query->get('id');
        $application = $this->as->applyForJob($user, $id) ;
        return ['application' => $application];

    }

    /**
     * @Route("invite", name="invite")
     * @Template()
     */
    public function invite(Request $request)
    {
        $id = $request->query->get('id');
        $invitation = $this->as->inviteCandidate($id);
        return ['invitation' => $invitation ];
    }



}
