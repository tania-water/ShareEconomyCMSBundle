<?php

namespace Ibtikar\ShareEconomyCMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CmsContactType
 *
 * @ORM\Table(name="cms_contact_type")
 * @ORM\Entity
 */
class CmsContactType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title_ar", type="string", length=255, nullable=true)
     */
    private $titleAr;

    /**
     * @var string
     *
     * @ORM\Column(name="title_en", type="string", length=255, nullable=true)
     */
    private $titleEn;



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
     * Set titleAr
     *
     * @param string $titleAr
     *
     * @return CmsContactType
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
     * Set titleEn
     *
     * @param string $titleEn
     *
     * @return CmsContactType
     */
    public function setTitleEn($titleEn)
    {
        $this->titleEn = $titleEn;

        return $this;
    }

    /**
     * Get titleEn
     *
     * @return string
     */
    public function getTitleEn()
    {
        return $this->titleEn;
    }

    /**
     * get name depending on current locale
     *
     * @param string $locale
     * @return string
     */
    public function getTitle($locale)
    {
        return $locale == 'ar' ? $this->getTitleAr() : $this->getTitleEn();
    }
}
