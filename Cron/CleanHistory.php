<?php

namespace Bydn\Logger\Cron;

use Bydn\Logger\Api\Data\AdminLogInterface;

/**
 * TODO:
 * System config for keep days
 */
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
     * @var \Bydn\Logger\Helper\Config
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
     * @param \Magento\Framework\App\ResourceConnection $resource
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $dateTime
     * @param \Bydn\Logger\Helper\Config $config
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Magento\Framework\App\ResourceConnection $resource,
        \Magento\Framework\Stdlib\DateTime\DateTime $dateTime,
        \Bydn\Logger\Helper\Config $config,
        \Psr\Log\LoggerInterface $logger
    )
    {
        $this->resource = $resource;
        $this->dateTime = $dateTime;
        $this->config = $config;
        $this->logger = $logger;
    }

    public function clean()
    {
        // Keep 15 days
        $keepHistoryDays = 15;
        $cutTimestamp = $this->dateTime->timestamp() - (86400 * $keepHistoryDays);
        $date = $this->dateTime->date('Y-m-d h:i:s', $cutTimestamp);

        // Delete from DB
        $this->connection = $this->resource->getConnection();
        $this->connection->query(
            'DELETE FROM bydn_admin_log WHERE created_at < "' . $date . '"'
        );
    }
}
