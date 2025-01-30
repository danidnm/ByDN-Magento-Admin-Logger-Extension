<?php

namespace Bydn\AdminLogger\Helper;

class Config extends \Magento\Framework\App\Helper\AbstractHelper
{
    private const LOGGER_ADMIN_MODULE_ENABLE = 'bydn_admin_logger/general/enable';
    private const LOGGER_ADMIN_LOGGER_ENABLE = 'bydn_admin_logger/general/enable_logger';
    private const LOGGER_ADMIN_LOGGER_FILTERS = 'bydn_admin_logger/general/filters';
    private const LOGGER_ADMIN_LOGGER_CLEAN_AFTER = 'bydn_admin_logger/general/clean_after';

    /**
     * Returns if admin logger is enabled
     *
     * @param null|int|string $storeId
     * @return mixed
     */
    public function isAdminLoggerModuleEnabled($storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::LOGGER_ADMIN_MODULE_ENABLE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Returns if admin logger is enabled
     *
     * @param null|int|string $storeId
     * @return mixed
     */
    public function isAdminLoggerEnabled($storeId = null)
    {
        $moduleEnabled = $this->isAdminLoggerModuleEnabled($storeId);
        $loggerEnabled = $this->scopeConfig->getValue(
            self::LOGGER_ADMIN_LOGGER_ENABLE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
        return $moduleEnabled && $loggerEnabled;
    }

    /**
     * Returns admin logger filters
     *
     * @param null|int|string $storeId
     * @return mixed
     */
    public function getAdminLoggerFilters($storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::LOGGER_ADMIN_LOGGER_FILTERS,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Returns days of clean up log entries
     *
     * @param null|int|string $storeId
     * @return mixed
     */
    public function getCleanDays($storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::LOGGER_ADMIN_LOGGER_CLEAN_AFTER,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
}
