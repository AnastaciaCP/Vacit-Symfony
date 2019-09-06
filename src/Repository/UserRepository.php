<?php

namespace App\Repository;

use App\Entity\User;
use App\Service\UserService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{

    private $um;
    private $encoder;


    public function __construct(RegistryInterface $registry,
                                UserManagerInterface $um,
                                UserPasswordEncoderInterface $encoder)
    {
        parent::__construct($registry, User::class);
        $this->um = $um;
        $this->encoder = $encoder;
    }

    /*
     * Checks if email of employer already exists. If not, adds employer as new user 
     */

    public function createEmployer($params) 
    {
        $e = $this->um->findUserByEmail($params["email"]);
        if(!$e) {
            $employer = $this->um->createUser();
            $employer->setUsername($params["email"]);
            $employer->setEmail($params["email"]);
            $employer->setEnabled(true);
            $password = $params["password"];
            $password = $this->encoder->encodePassword($employer, "default");
            $employer->setPassword($password);
            $employer->removeRole("ROLE_CANDIDATE");
            $employer->addRole("ROLE_EMPLOYER");
            $employer->setName($params["name"]);
            $employer->setPhonenumber($params["phonenumber"]);
            $employer->setAddress($params["address"]);
            $employer->setPostalcode($params["postalcode"]);
            $employer->setCity($params["city"]);
            $employer->setBiography($params["biography"]);
 
 
 
            $this->um->updateUser($employer);
            return ($employer);
        } else {
            return ("Deze werkgever staat al geregistreerd.");
        }
    }

    /*
     * Edits profile of candidate or employer
     */
    public function editProfile($user, $params) 
    {
        $user->setName($params["name"]);
        $user->setLastname($params["lastname"]);
        $user->setEmail($params["email"]);
        $user->setDateofbirth(new \DateTime($params["dateofbirth"]));
        $user->setPhonenumber($params["phonenumber"]);
        $user->setAddress($params["address"]);
        $user->setPostalcode($params["postalcode"]);
        $user->setCity($params["city"]);
        $user->setBiography($params["biography"]);

        $this->um->updateUser($user);
        return ($user);
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
}
