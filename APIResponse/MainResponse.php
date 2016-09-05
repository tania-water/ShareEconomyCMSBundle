<?php

namespace Ibtikar\ShareEconomyCMSBundle\APIResponse;

use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @author Karim Shendy <kareem.elshendy@ibtikar.net.sa>
 */
class MainResponse
{
    /**
     * @Assert\Type("integer")
     */
    public $code = 200;

    /**
     * @Assert\Type("boolean")
     */
    public $status = true;

    /**
     * @Assert\Type("string")
     */
    public $message = '';

}