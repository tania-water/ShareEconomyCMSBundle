<?php

namespace Ibtikar\ShareEconomyCMSBundle\Service\DashboardListFilters;

/**
 * @author Karim Shendy <kareem.elshendy@ibtikar.net.sa>
 */
class ContactUsTypeFilter implements \Ibtikar\ShareEconomyDashboardDesignBundle\Interfaces\ListFilterInterface
{
    private $em;
    private $currectRequest;

    /**
     * @param $em
     */
    public function __construct($em, $request)
    {
        $this->em             = $em;
        $this->currectRequest = $request->getCurrentRequest();
    }

    /**
     * @return  string  unique filter name
     */
    public function getName()
    {
        return "contact_type";
    }

    /**
     * @return array filter list menu (value => label)
     */
    public function getFilterList()
    {
        $return = [];
        $types  = $this->em->getRepository('IbtikarShareEconomyCMSBundle:CmsContactType')->findAll();

        foreach ($types as $type) {
            $return[$type->getId()] = $type->getTitle($this->currectRequest->getLocale());
        }

        return $return;
    }

    /**
     * @param \Doctrine\ORM\QueryBuilder $dql QueryBuilder instance
     *
     * @return \Doctrine\ORM\QueryBuilder QueryBuilder instance.
     */
    public function applyFilter(\Doctrine\ORM\QueryBuilder $dql, $val)
    {
        return $dql->andWhere('type.id = :val')
                ->setParameter('val', $val);
    }
}