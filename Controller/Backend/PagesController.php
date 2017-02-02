<?php

namespace Ibtikar\ShareEconomyCMSBundle\Controller\Backend;

use Symfony\Component\HttpFoundation\Request;
use Ibtikar\ShareEconomyDashboardDesignBundle\Controller\DashboardController;
use Ibtikar\ShareEconomyCMSBundle\Entity\Page;

class PagesController extends DashboardController
{
    protected $className    = 'Page';
    protected $entityBundle = 'IbtikarShareEconomyCMSBundle';
    protected $isSearchable = false;
    protected $translationDomain = 'page';
    protected $listActions  = [
        'view' => 'ibtikar_share_economy_cms_dashboard_pages_details',
        'edit' => 'ibtikar_share_economy_cms_dashboard_pages_edit'
    ];
    protected $listColumns  = [
            ['title', ['name' => 'Title En']],
            ['titleAr', ['name' => 'Title Ar']]
    ];
    protected $pageTitle    = 'CMS Pages List';

    protected $defaultSort = array('column' => 'title', 'sort' => 'asc');

    public function getListQuery()
    {
        $listTemplate = $this->getParameter('ibtikar_share_economy_cms.dashboard_list_template');
        $this->get('twig')->addGlobal('ibtikar_share_economy_cms_dashboard_list_template', $listTemplate);

        return parent::getListQuery();
    }

    /**
     *
     * @param Request $request
     * @param type $id
     * @return type
     */
    public function detailsAction(Request $request, $id)
    {
        $listTemplate = $this->getParameter('ibtikar_share_economy_cms.dashboard_layout');
        $this->get('twig')->addGlobal('ibtikar_share_economy_cms_dashboard_layout', $listTemplate);

        $em   = $this->getDoctrine()->getManager();
        $page = $em->getRepository($this->entityBundle . ':' . $this->className)->find($id);

        if (!$page) {
            throw $this->createNotFoundException();
        }

        return $this->render('IbtikarShareEconomyCMSBundle:Dashboard/Pages:details.html.twig', ['page' => $page]);
    }

    /**
     * Edits an existing page entity.
     */
    public function editPageAction(Request $request, Page $page)
    {
        $listTemplate = $this->getParameter('ibtikar_share_economy_cms.dashboard_layout');
        $this->get('twig')->addGlobal('ibtikar_share_economy_cms_dashboard_layout', $listTemplate);

        $em   = $this->getDoctrine()->getManager();
        $form = $this->createForm('Ibtikar\ShareEconomyCMSBundle\Form\PageType', $page, [
            'method' => 'POST',
            'translation_domain'=>$this->translationDomain
        ]);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em->flush();

                $this->addFlash('success', $this->get('translator')->trans('Done Successfully'));
                return $this->redirectToRoute('ibtikar_share_economy_cms_dashboard_pages_list');
            }
        }
        return $this->render('IbtikarShareEconomyCMSBundle:Dashboard/Pages:edit.html.twig', ['form' => $form->createView(), 'applyTextEditor' => $this->getParameter('ibtikar_share_economy_cms.applyTextEditor')]);
    }
}