<?php

namespace Ibtikar\ShareEconomyCMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PageController extends Controller
{

    /**
     * view page by slug
     *
     * @author Karim Shendy <kareem.elshendy@ibtikar.net.sa>
     * @param string $slug
     * @return Response
     */
    public function viewPageAction($slug)
    {
        $page = $this->getDoctrine()->getManager()->getRepository('IbtikarShareEconomyCMSBundle:Page')->findOneBySlug($slug);

        if (!$page) {
            throw $this->createNotFoundException();
        }

        $layout = $this->getParameter('ibtikar_share_economy_cms.frontend_layout');

        return $this->render('IbtikarShareEconomyCMSBundle:Pages:view.html.twig', ['page' => $page, 'layout' => $layout]);
    }
}