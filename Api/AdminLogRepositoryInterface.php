<?php

namespace Bydn\AdminLogger\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;

interface AdminLogRepositoryInterface
{
    /**
     * Retrieve entity.
     *
     * @param int $id
     * @return \Bydn\AdminLogger\Api\Data\AdminLogInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($id);

    /**
     * Retrieve admin logs matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return \Bydn\AdminLogger\Api\Data\AdminLogSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Save log entry
     *
     * @param \Bydn\AdminLogger\Api\Data\AdminLogInterface $logEntry
     * @return \Bydn\AdminLogger\Api\Data\AdminLogInterface
     * @throws LocalizedException
     */
    public function save(\Bydn\AdminLogger\Api\Data\AdminLogInterface $logEntry): \Bydn\AdminLogger\Api\Data\AdminLogInterface;
}
