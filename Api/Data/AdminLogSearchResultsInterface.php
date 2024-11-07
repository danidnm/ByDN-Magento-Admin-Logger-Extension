<?php

namespace Bydn\AdminLogger\Api\Data;

use Bydn\AdminLogger\Api\Data\AdminLogInterface;
use Magento\Framework\Api\SearchResultsInterface;

interface AdminLogSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get admin logs
     *
     * @return AdminLogInterface[]
     */
    public function getItems(): array;

    /**
     * Set admin logs
     *
     * @param AdminLogInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
