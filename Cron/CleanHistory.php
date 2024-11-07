<?php

namespace Bydn\AdminLogger\Cron;

use Bydn\AdminLogger\Api\Data\AdminLogInterface;

class CleanHistory
{
    /**
     * @var \Magento\Framework\App\ResourceConnection
     */
    private $resource;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    private $dateTime;

    /**
     * @var \Bydn\AdminLogger\Helper\Config
     */
    private $config;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * @var \Magento\Framework\DB\Adapter\AdapterInterface
     */
    private $connection;

    /**
     * CleanHistory constructor.
     *
     * @param \Magento\Framework\App\ResourceConnection $resource
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $dateTime
     * @param \Bydn\AdminLogger\Helper\Config $config
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Magento\Framework\App\ResourceConnection $resource,
        \Magento\Framework\Stdlib\DateTime\DateTime $dateTime,
        \Bydn\AdminLogger\Helper\Config $config,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->resource = $resource;
        $this->dateTime = $dateTime;
        $this->config = $config;
        $this->logger = $logger;
    }

    /**
     * Clean entries from database
     *
     * @return void
     */
    public function clean()
    {
        // Keep 15 days
        $keepHistoryDays = $this->config->getCleanDays();
        if (!is_numeric($keepHistoryDays)) {
            $keepHistoryDays = 15;
        }
        $cutTimestamp = $this->dateTime->timestamp() - (86400 * $keepHistoryDays);
        $date = $this->dateTime->date('Y-m-d h:i:s', $cutTimestamp);

        // Delete from DB
        $this->connection = $this->resource->getConnection();
        $tableName = $this->connection->getTableName('bydn_admin_log');
        $this->connection->query(
            'DELETE FROM ' . $tableName . ' WHERE created_at < "' . $date . '"'
        );
    }
}
