<?php

namespace Ibtikar\ShareEconomyCMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ibtikar\ShareEconomyCMSBundle\Entity\CmsContactType;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CmsContact
 *
 * @ORM\Table(name="cms_contact", indexes={@ORM\Index(name="type_id", columns={"type_id"})})
 * @ORM\Entity
 */
class CmsContact
{
    use \Ibtikar\ShareEconomyToolsBundle\Entity\TrackableTrait;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=190, nullable=true)
     *
     * @Assert\NotBlank(message="fill_mandatory_field")
     * @Assert\Length(max = 140)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     *
     * @Assert\Length(max = 900)
     */
    private $description;

    /**
     * @var CmsContactType
     *
     * @ORM\ManyToOne(targetEntity="Ibtikar\ShareEconomyCMSBundle\Entity\CmsContactType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     *
     * @Assert\NotBlank(message="fill_mandatory_field")
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="Ibtikar\TaniaModelBundle\Entity\User")
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     */
    private $user;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return CmsContact
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return CmsContact
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set type
     *
     * @param CmsContactType $type
     *
     * @return CmsContact
     */
    public function setType(CmsContactType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return CmsContactType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set user
     *
     * @param \Ibtikar\ShareEconomyUMSBundle\Entity\BaseUser $user
     *
     * @return CmsContact
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Ibtikar\ShareEconomyUMSBundle\Entity\BaseUser
     */
    public function getUser()
    {
        return $this->user;
    }

    public function displayUserName()
    {
        return $this->getUser() ? $this->getUser()->getFullName() : "---";
    }

    public function getTypeName()
    {
        return $this->getType() ? $this->getType()->getTitleEn() : "---";
    }
}
