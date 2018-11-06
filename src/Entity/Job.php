<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JobRepository")
 * @ORM\Table(name="jobs")
 * @ORM\HasLifecycleCallbacks()
 *
 * @JMS\ExclusionPolicy("all")
 */
class Job
{
    public const FULL_TIME_TYPE = 'full-time';
    public const PART_TIME_TYPE = 'part-time';
    public const FREELANCER_TYPE = 'freelancer';

    public const TYPES = [
        self::FULL_TIME_TYPE,
        self::PART_TIME_TYPE,
        self::FREELANCER_TYPE,
    ];

    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @JMS\Expose()
     * @JMS\Type("int")
     */
    private $id;

    /**
     * @var Category
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="jobs")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=false)
     */
    private $category;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     *
     * @JMS\Expose()
     * @JMS\Type("string")
     */
    private $type;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @JMS\Expose()
     * @JMS\Type("string")
     */
    private $company;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     * @JMS\Expose()
     * @JMS\Type("string")
     */
    private $url;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @JMS\Expose()
     * @JMS\Type("string")
     */
    private $position;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @JMS\Expose()
     * @JMS\Type("string")
     */
    private $location;

    /**
     * @var string
     * @ORM\Column(type="text")
     * @JMS\Expose()
     * @JMS\Type("string")
     */
    private $description;

    /**
     * @var string
     * @ORM\Column(type="text")
     * @JMS\Expose()
     * @JMS\Type("string")
     */
    private $howToApply;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $token;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $public;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $activated;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @var \Datetime
     * @ORM\Column(type="datetime")
     * @JMS\Expose()
     * @JMS\Type("DateTime")
     */
    private $expiresAt;

    /**
     * @var \Datetime
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var \Datetime
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Category
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * @JMS\VirtualProperty
     * @JMS\SerializedName("category_name")
     * @return null|string
     */
    public function getCategoryName()
    {
        return $this->getCategory()->getName();
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getCompany(): ?string
    {
        return $this->company;
    }

    /**
     * @param string $company
     */
    public function setCompany(string $company): void
    {
        $this->company = $company;
    }


    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @return self
     */
    public function setLogo( $logo)
    {
        $this->logo = $logo;
        return $this;
    }

    /**
     * @JMS\VirtualProperty
     * @JMS\SerializedName("logo_path")
     * @return null|string
     */
    public function getLogoPath()
    {
        return $this->getLogo() ? 'uploads/jobs' . $this->getLogo() : null;
    }

    /**
     * @return null|string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param null|string $url
     */
    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getPosition(): ?string
    {
        return $this->position;
    }

    /**
     * @param string $position
     */
    public function setPosition(string $position): void
    {
        $this->position = $position;
    }

    /**
     * @return string
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getHowToApply(): ?string
    {
        return $this->howToApply;
    }

    /**
     * @param string $howToApply
     */
    public function setHowToApply(string $howToApply): void
    {
        $this->howToApply = $howToApply;
    }

    /**
     * @return string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    /**
     * @return bool
     */
    public function isPublic(): ?bool
    {
        return $this->public;
    }

    /**
     * @param bool $public
     */
    public function setPublic(bool $public): void
    {
        $this->public = $public;
    }

    /**
     * @return bool
     */
    public function isActivated(): ?bool
    {
        return $this->activated;
    }

    /**
     * @param bool $activated
     */
    public function setActivated(bool $activated): void
    {
        $this->activated = $activated;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return \Datetime
     */
    public function getExpiresAt(): \Datetime
    {
        return $this->expiresAt;
    }

    /**
     * @param \Datetime $expiresAt
     */
    public function setExpiresAt(\Datetime $expiresAt): void
    {
        $this->expiresAt = $expiresAt;
    }

    /**
     * @return \Datetime
     */
    public function getCreatedAt(): \Datetime
    {
        return $this->createdAt;
    }

    /**
     * @param \Datetime $createdAt
     */
    public function setCreatedAt(\Datetime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \Datetime
     */
    public function getUpdatedAt(): \Datetime
    {
        return $this->updatedAt;
    }

    /**
     * @param \Datetime $updatedAt
     */
    public function setUpdatedAt(\Datetime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }


    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();

        if(!$this->expiresAt){
            $this->expiresAt = (clone $this->createdAt)->modify('+30 days');
        }
    }

    /**
     * @ORM\PreUpdate()     */
    public function preUpdate()
    {
        $this->updatedAt = new \DateTime();
    }


}
