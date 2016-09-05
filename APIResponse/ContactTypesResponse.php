<?php

namespace Ibtikar\ShareEconomyCMSBundle\APIResponse;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Karim Shendy <kareem.elshendy@ibtikar.net.sa>
 */
class ContactTypesResponse extends MainResponse
{
    /**
     * @Assert\Type("array")
     */
    public $items = [];

}