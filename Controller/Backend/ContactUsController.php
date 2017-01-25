<?php

namespace Ibtikar\ShareEconomyCMSBundle\Controller\Backend;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Ibtikar\ShareEconomyDashboardDesignBundle\Controller\DashboardController;

class ContactUsController extends DashboardController
{
    protected $className       = 'CmsContact';
    protected $entityBundle    = 'IbtikarShareEconomyCMSBundle';
    protected $isSearchable    = false;
    protected $listActions     = [
        'delete' => 'ibtikar_share_economy_cms_dashboard_contact_us_delete'
    ];
    protected $listBulkActions = [
        'delete' => 'ibtikar_share_economy_cms_dashboard_contact_us_multiple_delete'
    ];
    protected $listColumns     = [
            ['title', ['name' => 'Title']],
            ['description', ['name' => 'Message', 'isSortable' => false]],
            ['user', ['method' => 'displayUserName', 'isSortable' => false]],
            ['type', ['method' => 'getTypeName', 'isSortable' => false]],
            ['createdAt', ['name' => 'Created at', 'type' => 'date']]
    ];
    protected $pageTitle       = 'Contact Us List';

    public function getListQuery()
    {
        $listTemplate = $this->getParameter('ibtikar_share_economy_cms.dashboard_list_template');
        $this->get('twig')->addGlobal('ibtikar_share_economy_cms_dashboard_list_template', $listTemplate);

        return $this->getDoctrine()->getManager()->createQueryBuilder()
                ->from($this->entityBundle . ':' . $this->className, 'e')
                ->select('e, type, user')
                ->leftJoin('e.type', 'type')
                ->leftJoin('e.user', 'user');
    }

    /**
     * contact us filters
     *
     * @return array
     */
    protected function getListFilters()
    {
        return [
            $this->get("shareEconomyCms.contact_us_type_filter"),
        ];
    }

    /**
     * @return type
     */
    protected function getListOneInputSearch()
    {
        return $this->get("shareEconomyCms.contact_us_one_field_search");
    }

    /**
     * @param int $id
     */
    public function deleteAction($id)
    {
        $em     = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('IbtikarShareEconomyCMSBundle:CmsContact')->find($id);

        if ($entity) {
            $em->remove($entity);
            $em->flush();

            return new JsonResponse(array('status' => 'success', 'message' => $this->get('translator')->trans('Done Successfully')));
        }

        return new JsonResponse(array('status' => 'error', 'message' => $this->get('translator')->trans('Failed Operation')));
    }

    /**
     * @param Request $request
     */
    public function multipleDeleteAction(Request $request)
    {
        $em   = $this->getDoctrine()->getManager();
        $form = $this->createActionForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $ids = explode(',', $form->getData()['data']);

            if (count($ids)) {
                $deletedCount = 0;

                foreach ($ids as $id) {
                    $entity = $em->getRepository('IbtikarShareEconomyCMSBundle:CmsContact')->find($id);

                    if ($entity) {
                        $em->remove($entity);
                        $em->flush();

                        $deletedCount++;
                    }
                }

                return new JsonResponse(['status' => 'success', 'message' => $deletedCount . " recoreds has been deleted successfully."]);
            }
        }

        return new JsonResponse(['status' => 'error', 'message' => $this->get('translator')->trans('Failed Operation')]);
    }
}