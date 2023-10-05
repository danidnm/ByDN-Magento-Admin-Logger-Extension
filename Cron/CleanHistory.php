<?php

namespace Bydn\Logger\Cron;

use Bydn\Logger\Api\Data\AdminLogInterface;

class CleanHistory
{
    /**
     * @var \Magento\Framework\DB\Adapter\AdapterInterface
     */
    private $connection;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    private $dateTime;

    /**
     * @var int
     */
    private $timeStampKeepHistory;

    /**
     * CleanHistory constructor.
     * @param \Magento\Framework\App\ResourceConnection $resource
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $dateTime
     * @param \Bydn\Logger\Helper\Config $config
     * @param \Bydn\Logger\Model\LoggerInterface $logger
     */
    public function __construct(
        \Magento\Framework\App\ResourceConnection $resource,
        \Magento\Framework\Stdlib\DateTime\DateTime $dateTime,
        \Bydn\Logger\Helper\Config $config,
        \Bydn\Logger\Model\LoggerInterface $logger
    )
    {
        $this->connection = $resource->getConnection();
        $this->dateTime = $dateTime;
        $this->config = $config;
        $this->logger = $logger;
    }

    public function clean()
    {
        $keepHistoryDays = 15;
        $this->timeStampKeepHistory = $this->dateTime->timestamp() - (86400 * $keepHistoryDays);
        $this->deleteFromDb();
    }

    private function deleteFromDb()
    {
        $date = $this->dateTime->date('Y-m-d h:i:s', $this->timeStampKeepHistory);
        $this->connection->query(
            'DELETE FROM bydn_admin_log WHERE created_at < "' . $date . '"'
        );
    }
}
