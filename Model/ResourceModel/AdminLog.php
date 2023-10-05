<?php

namespace Bydn\Logger\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class AdminLog extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('bydn_admin_log', 'id');
    }
}
