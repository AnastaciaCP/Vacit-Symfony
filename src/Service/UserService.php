<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use App\Entity\User;
use App\Repository\UserRepository;

class UserService
{
    private $em;
    protected $rep;


    /* 
     * Function: construct
     * Purpose: Class constructor
     * Tasks: Autowiring class
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->rep = $this->em->getRepository(User::class);

    }

    /* 
     * Finds user with specific ID
     */
    public function find($id) {
        return $this->rep->find($id);

    }

    /*
     * Finds all users
     */
    public function findAll() {
        return $this->rep->findAll();
    }

    /*
     * creates User for every employer in spreadsheet
     */

    public function createEmployer($params) 
    {
        return $this->rep->createEmployer($params);
    }

    /* 
     * update User profile
     */
    public function editProfile($user, $params) {
        return $this->rep->editProfile($user, $params);
    }

    /*
     * update User profile with CV file
     */
    public function uploadCV($user, $file) {
        return $this->rep->uploadCV($user, $file);
    }



}




?>