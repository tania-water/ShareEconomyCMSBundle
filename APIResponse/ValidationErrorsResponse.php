<?php

namespace Ibtikar\ShareEconomyCMSBundle\APIResponse;

use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @author Karim Shendy <kareem.elshendy@ibtikar.net.sa>
 */
class ValidationErrorsResponse extends MainResponse
{
    /**
     * @Assert\Type("integer")
     */
    public $code = 400;

    /**
     * @Assert\Type("boolean")
     */
    public $status = false;

    /**
     * @Assert\Type("array")
     */
    public $errors = [];

}