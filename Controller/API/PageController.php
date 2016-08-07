<?php

namespace Ibtikar\ShareEconomyCMSBundle\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Ibtikar\ShareEconomyCMSBundle\APIResponse as CMSAPIResponse;

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
     *  statusCodes={
     *      200="Returned on success",
     *      403="Returned if the api key is not valid",
     *      404="Returned if the page was not found"
     *  },
     *  responseMap = {
     *      200="Ibtikar\ShareEconomyCMSBundle\APIResponse\SuccessPage",
     *      403="Ibtikar\ShareEconomyToolsBundle\APIResponse\InvalidAPIKey",
     *      404="Ibtikar\ShareEconomyToolsBundle\APIResponse\NotFound"
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
            $pageResponse = new CMSAPIResponse\Page();
            $pageResponse->id = $page->getId();
            $pageResponse->slug = $page->getSlug();
            $pageResponse->title = $page->getTitle();
            $pageResponse->titleAr = $page->getTitleAr();
            $pageResponse->content = $page->getContent();
            $pageResponse->contentAr = $page->getContentAr();
            $successPageResponse = new CMSAPIResponse\SuccessPage();
            $successPageResponse->page = $pageResponse;
            return $APIOperations->getJsonResponseForObject($successPageResponse);
        }
        return $APIOperations->getNotFoundErrorJsonResponse();
    }
}
