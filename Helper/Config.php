<?php

namespace Bydn\AdminLogger\Helper;

class Config extends \Magento\Framework\App\Helper\AbstractHelper
{
    private const LOGGER_ADMIN_LOGGER_ENABLE = 'bydn_admin_logger/general/enable';
    
    /**
     * Returns if admin logger is enabled
     *
     * @param null|int|string $storeId
     * @return mixed
     */
    public function isAdminLoggerEnabled($storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::LOGGER_ADMIN_LOGGER_ENABLE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
}
