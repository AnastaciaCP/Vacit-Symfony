<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use App\Service\UserService;
use App\Service\JobsService;

class UserController extends AbstractController
{

    private $us;
    private $js;

    /**
     * @Route("/candidate/{id<\d+>}", name="candidate")
     * @Template()
     */
    public function findCandidate($id)
    {
        $candidate = $this->us->find($id);
        return ['user' => $candidate];
        
    }


    /**
     * @Route("/employer/{id}", name="employer")
     * @Template()
     */
    public function findEmployer($id)
    {
        $employer = $this->us->find($id);
        $jobs = $this->js->findAllfromUser($employer);
        return ['user' => $employer,
                'jobs' => $jobs];
    }


    /**
     * @Route("/edit-profile", name="edit_profile")
     * @Template()
     */
    public function editProfile(Request $request) {
        $user = $this->getUser();
        $params = $request->request->all();
        if(!empty($params)) {
           $user = $this->us->editProfile($user, $params); 
        }
        
        return ['user' => $user,
                'params' => $params];
    }

    /**
     * @Route("/uploadCV", name="uploadCV")
     */
    public function uploadCV(Request $request) 
    {
        $file = $request->files->get('file');

        return ['file' => $file];
    }

    public function __construct(UserService $us,
                                JobsService $js) {
        $this->us = $us;
        $this->js = $js;
    }

}
