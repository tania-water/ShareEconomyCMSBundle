<?php

namespace Ibtikar\ShareEconomyCMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class PageController extends Controller
{

    /**
     * view page by slug
     *
     * @author Karim Shendy <kareem.elshendy@ibtikar.net.sa>
     * @param string $slug
     * @return Response
     */
    public function viewPageAction(Request $request, $slug)
    {
        $page = $this->getDoctrine()->getManager()->getRepository('IbtikarShareEconomyCMSBundle:Page')->findOneBySlug($slug);

        if (!$page) {
            throw $this->createNotFoundException();
        }

        $template = $this->getParameter('ibtikar_share_economy_cms.frontend_template');

        return $this->render($template, ['page' => $page,'isEditor'=>$this->getParameter('ibtikar_share_economy_cms.applyTextEditor')]);
    }
}