<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ApplicationsRepository")
 */
class Applications
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date_application;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $invitation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\user", inversedBy="applications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $candidate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\jobs", inversedBy="applications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $jobs;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateApplication(): ?\DateTimeInterface
    {
        return $this->date_application;
    }

    public function setDateApplication(\DateTimeInterface $date_application): self
    {
        $this->date_application = $date_application;

        return $this;
    }

    public function getInvitation(): ?bool
    {
        return $this->invitation;
    }

    public function setInvitation(?bool $invitation): self
    {
        $this->invitation = $invitation;

        return $this;
    }

    public function getCandidate(): ?user
    {
        return $this->candidate;
    }

    public function setCandidate(?user $candidate): self
    {
        $this->candidate = $candidate;

        return $this;
    }

    public function getJobs(): ?jobs
    {
        return $this->jobs;
    }

    public function setJobs(?jobs $jobs): self
    {
        $this->jobs = $jobs;

        return $this;
    }
}
