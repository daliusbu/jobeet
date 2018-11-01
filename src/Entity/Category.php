<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 * @ORM\Table(name="categories")
 */
class Category
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $name;


    /**
     * @var Job[]|ArrayCollection
     * @ORM\OneToMany(targetEntity="Job", mappedBy="category")
     */
    private $jobs;

    /**
     * @var Affiliate[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Affiliate", mappedBy="categories")
     */
    private $affiliates;


    public function __construct()
    {
        $this->jobs = new ArrayCollection();
        $this->affiliates = new ArrayCollection();
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

    /**
     * @return Job[]|ArrayCollection
     */
    public function getJobs()
    {
        return $this->jobs;
    }

    /**
     * @param Job $job
     * @return Category
     */
    public function addJob(Job $job): self
    {
        if(! $this->jobs->contains($job)){
            $this->jobs->add($job);
        }
        return $this;
    }


    /**
     * @param Job $job
     * @return Category
     */
    public function removeJob(Job $job): self
    {
        if($this->jobs->contains($job)){
            $this->jobs->removeElement($job);
        }
        return $this;
    }

    /**
     * @return Affiliate[]|ArrayCollection
     */
    public function getAffiliates()
    {
        return $this->affiliates;
    }

    /**
     * @param Affiliate $affiliate
     * @return Category
     */
    public function addAffiliates($affiliate): self
    {
        if(! $this->affiliates->contains(@$affiliate)){
            $this->affiliates->add($affiliate);
        }
        return $this;
    }

    /**
     * @param Affiliate $affiliate
     * @return Category
     */
    public function removeAffiliate($affiliate): self
    {
        if ($this->affiliates->contains($affiliate)){
            $this->affiliates->removeElement($affiliate);
        }
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getActiveJobs()
    {
        return $this->jobs->filter(function (Job $job){
            return $job->getExpiresAt() > new \DateTime();
        });
    }

}
