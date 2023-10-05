<?php

namespace Bydn\Logger\Model\ResourceModel\AdminLog;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \Bydn\Logger\Model\AdminLog::class,
            \Bydn\Logger\Model\ResourceModel\AdminLog::class
        );
    }
}
