<?php

namespace Ibtikar\ShareEconomyCMSBundle\APIResponse;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Mahmoud Mostafa <mahmoud.mostafa@ibtikar.net.sa>
 */
class Page
{

    /**
     * @Assert\Type(type="string")
     */
    public $id;

    /**
     * @Assert\Type(type="string")
     */
    public $slug;

    /**
     * @Assert\Type(type="string")
     */
    public $title;

    /**
     * @Assert\Type(type="string")
     */
    public $titleAr;

    /**
     * @Assert\Type(type="string")
     */
    public $content;

    /**
     * @Assert\Type(type="string")
     */
    public $contentAr;

}
