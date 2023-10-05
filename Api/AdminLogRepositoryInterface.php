<?php

namespace Bydn\Logger\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;

interface AdminLogRepositoryInterface
{
    /**
     * Retrieve entity.
     *
     * @param int $id
     * @return \Bydn\Logger\Api\Data\AdminLogInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($id);

    /**
     * Retrieve admin logs matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return \Bydn\Logger\Api\Data\AdminLogSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Save log entry
     *
     * @param \Bydn\Logger\Api\Data\AdminLogInterface $logEntry
     * @return \Bydn\Logger\Api\Data\AdminLogInterface
     * @throws LocalizedException
     */
    public function save(\Bydn\Logger\Api\Data\AdminLogInterface $logEntry): \Bydn\Logger\Api\Data\AdminLogInterface;
}
