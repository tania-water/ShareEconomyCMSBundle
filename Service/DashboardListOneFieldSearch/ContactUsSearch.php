<?php

namespace Ibtikar\ShareEconomyCMSBundle\Service\DashboardListOneFieldSearch;

/**
 * @author Karim Shendy <kareem.elshendy@ibtikar.net.sa>
 */
class ContactUsSearch implements \Ibtikar\ShareEconomyDashboardDesignBundle\Interfaces\OneInputSearchInterface
{
    public function getInputPlaceHolder()
    {
        return "Search in user names and emails";
    }

    /**
     * @param \Doctrine\ORM\QueryBuilder $dql QueryBuilder instance
     *
     * @return \Doctrine\ORM\QueryBuilder QueryBuilder instance.
     */
    public function applySearch(\Doctrine\ORM\QueryBuilder $dql, $searchKey)
    {
        $rootAlias = $dql->getRootAliases()[0];

        return $dql->andWhere("(user.fullName LIKE :keyword OR user.email LIKE :keyword)")
                ->setParameter('keyword', '%' . $searchKey . '%');
    }
}