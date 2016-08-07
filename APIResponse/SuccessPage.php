<?php

namespace Ibtikar\ShareEconomyCMSBundle\APIResponse;

use Ibtikar\ShareEconomyToolsBundle\APIResponse\Success;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Mahmoud Mostafa <mahmoud.mostafa@ibtikar.net.sa>
 */
class SuccessPage extends Success
{

    /**
     * @Assert\Type(type="Page")
     */
    public $page;

}
