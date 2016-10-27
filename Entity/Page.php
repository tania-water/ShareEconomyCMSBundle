<?php

namespace Ibtikar\ShareEconomyCMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Page
 *
 * @ORM\Table(name="page")
 * @ORM\Entity(repositoryClass="Ibtikar\ShareEconomyCMSBundle\Repository\PageRepository")
 */
class Page
{

    use \Ibtikar\ShareEconomyToolsBundle\Entity\TrackableTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=190, unique=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="titleAr", type="string", length=190, unique=true)
     */
    private $titleAr;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=190, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="contentAr", type="text", nullable=true)
     */
    private $contentAr;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->title;
    }

    /**
     * Get id
     *
     * @return int
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
     * @return Page
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
     * Set titleAr
     *
     * @param string $titleAr
     *
     * @return Page
     */
    public function setTitleAr($titleAr)
    {
        $this->titleAr = $titleAr;

        return $this;
    }

    /**
     * Get titleAr
     *
     * @return string
     */
    public function getTitleAr()
    {
        return $this->titleAr;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Page
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Page
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set contentAr
     *
     * @param string $contentAr
     *
     * @return Page
     */
    public function setContentAr($contentAr)
    {
        $this->contentAr = $contentAr;

        return $this;
    }

    /**
     * Get contentAr
     *
     * @return string
     */
    public function getContentAr()
    {
        return $this->contentAr;
    }
}
