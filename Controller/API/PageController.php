<?php

namespace Ibtikar\ShareEconomyCMSBundle\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Ibtikar\ShareEconomyCMSBundle\APIResponse\Page;

class PageController extends Controller
{

    /**
     * Get Page data by slug
     *
     * @ApiDoc(
     *  section="Page",
     *  requirements={
     *      {
     *          "name"="slug",
     *          "dataType"="string",
     *          "requirement"="about|privacy-policy|terms-and-conditions",
     *          "description"="The page unique slug"
     *      }
     *  },
     *  statusCodes = {
     *      200 = "Returned on success",
     *      404 = "If the page was not found"
     *  },
     *  responseMap = {
     *      200 = "Ibtikar\ShareEconomyCMSBundle\APIResponse\Page",
     *      404 = "Ibtikar\ShareEconomyToolsBundle\APIResponse\NotFound"
     *  }
     * )
     * @author Mahmoud Mostafa <mahmoud.mostafa@ibtikar.net.sa>
     * @param string $slug
     * @return JsonResponse
     */
    public function getPageDataAction($slug)
    {
        $APIOperations = $this->get('api_operations');
        $page = $this->getDoctrine()->getManager()->getRepository('IbtikarShareEconomyCMSBundle:Page')->findOneBySlug($slug);
        if ($page) {
            $pageResponse = new Page();
            $pageResponse->id = $page->getId();
            $pageResponse->slug = $page->getSlug();
            $pageResponse->title = $page->getTitle();
            $pageResponse->content = $page->getContent();
            return $APIOperations->getJsonResponseForObject($page);
        }
        return $APIOperations->getNotFoundErrorResponse();
    }

}