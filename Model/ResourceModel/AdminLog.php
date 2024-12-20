<?php

namespace Bydn\AdminLogger\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class AdminLog extends AbstractDb
{
    /**
     * Class constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('bydn_admin_log', 'id');
    }
}
