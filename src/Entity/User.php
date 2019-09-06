<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $lastname;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateofbirth;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $phonenumber;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $postalcode;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $biography;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $file;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Jobs", mappedBy="user", orphanRemoval=true)
     */
    private $jobs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Applications", mappedBy="candidate", orphanRemoval=true)
     */
    private $applications;

    /**
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    private $profile_file;

    public function __construct()
    {
        parent::__construct();
        $this->jobs = new ArrayCollection();
        $this->applications = new ArrayCollection();
        $this->addRole("ROLE_CANDIDATE");
        // $this->setUsername($this->email);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getDateofbirth(): ?\DateTimeInterface
    {
        return $this->dateofbirth;
    }

    public function setDateofbirth(?\DateTimeInterface $dateofbirth): self
    {
        $this->dateofbirth = $dateofbirth;

        return $this;
    }

    public function getPhonenumber(): ?string
    {
        return $this->phonenumber;
    }

    public function setPhonenumber(string $phonenumber): self
    {
        $this->phonenumber = $phonenumber;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPostalcode(): ?string
    {
        return $this->postalcode;
    }

    public function setPostalcode(string $postalcode): self
    {
        $this->postalcode = $postalcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(string $biography): self
    {
        $this->biography = $biography;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(?string $file): self
    {
        $this->file = $file;

        return $this;
    }

    /**
     * @return Collection|Jobs[]
     */
    public function getJobs(): Collection
    {
        return $this->jobs;
    }

    public function addJob(Jobs $job): self
    {
        if (!$this->jobs->contains($job)) {
            $this->jobs[] = $job;
            $job->setUser($this);
        }

        return $this;
    }

    public function removeJob(Jobs $job): self
    {
        if ($this->jobs->contains($job)) {
            $this->jobs->removeElement($job);
            // set the owning side to null (unless already changed)
            if ($job->getUser() === $this) {
                $job->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Applications[]
     */
    public function getApplications(): Collection
    {
        return $this->applications;
    }

    public function addApplication(Applications $application): self
    {
        if (!$this->applications->contains($application)) {
            $this->applications[] = $application;
            $application->setCandidate($this);
        }

        return $this;
    }

    public function removeApplication(Applications $application): self
    {
        if ($this->applications->contains($application)) {
            $this->applications->removeElement($application);
            // set the owning side to null (unless already changed)
            if ($application->getCandidate() === $this) {
                $application->setCandidate(null);
            }
        }

        return $this;
    }

    public function getProfileFile(): ?string
    {
        return $this->profile_file;
    }

    public function setProfileFile(?string $profile_file): self
    {
        $this->profile_file = $profile_file;

        return $this;
    }
}
