<?php 

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use FOS\UserBundle\Model\UserManagerInterface;

use App\Entity\Applications;
use App\Repository\ApplicationsRepository;

use App\Service\JobsService;
use App\Service\UserService;

class ApplicationsService 
{
    private $em;
    private $um;
    private $js;
    private $us;

    protected $rep;


    public function __construct(EntityManagerInterface $em,
                                UserManagerInterface $um,
                                JobsService $js,
                                UserService $us)
    {
        $this->em = $em;
        $this->um = $um;
        $this->js = $js;
        $this->rep = $this->em->getRepository(Applications::class);
    }

    public function applyForJob($user, $id) 
    {
        $job = $this->js->find($id);
        return $this->rep->applyForJob($user, $job);
    }


    public function inviteCandidate($id)
    {
        $invitation = $this->rep->find($id);
        return $this->rep->inviteCandidate($invitation);
    }






}