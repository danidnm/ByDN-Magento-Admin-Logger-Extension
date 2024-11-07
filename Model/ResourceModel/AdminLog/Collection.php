<?php

namespace Bydn\AdminLogger\Model\ResourceModel\AdminLog;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Class constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Bydn\AdminLogger\Model\AdminLog::class,
            \Bydn\AdminLogger\Model\ResourceModel\AdminLog::class
        );
    }
}
