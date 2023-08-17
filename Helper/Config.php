<?php

namespace Bydn\Logger\Helper;

class Config extends \Magento\Framework\App\Helper\AbstractHelper
{
    private const LOGGER_EMAIL_NOTIFICATION_ENABLE = 'bydn_logger/email/enable';
    private const LOGGER_EMAIL_NOTIFICATION_EMAIL = 'bydn_logger/email/email';
    private const LOGGER_EMAIL_EXCEPTIONS = 'bydn_logger/email/exceptions';
    private const LOGGER_TELEGRAM_NOTIFICATION_ENABLE = 'bydn_logger/telegram/enable';
    private const LOGGER_TELEGRAM_NOTIFICATION_TOKEN = 'bydn_logger/telegram/token';
    private const LOGGER_TELEGRAM_NOTIFICATION_CHAT_ID = 'bydn_logger/telegram/chat_id';
    private const LOGGER_TELEGRAM_EXCEPTIONS = 'bydn_logger/telegram/exceptions';

    /**
     * Check if email notification is enabled
     *
     * @param null|int|string $storeId
     * @return mixed
     */
    public function isEmailNotificationEnabled($storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::LOGGER_EMAIL_NOTIFICATION_ENABLE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Check if email exceptions by email is enabled
     *
     * @param null|int|string $storeId
     * @return mixed
     */
    public function isEmailExceptionsEnabled($storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::LOGGER_EMAIL_EXCEPTIONS,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Returns notification email
     *
     * @param null|int|string $storeId
     * @return mixed
     */
    public function getNotificationEmail($storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::LOGGER_EMAIL_NOTIFICATION_EMAIL,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Check if email notification is enabled
     *
     * @param null|int|string $storeId
     * @return mixed
     */
    public function isTelegramNotificationEnabled($storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::LOGGER_TELEGRAM_NOTIFICATION_ENABLE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Check if email exceptions by email is enabled
     *
     * @param null|int|string $storeId
     * @return mixed
     */
    public function isTelegramExceptionsEnabled($storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::LOGGER_TELEGRAM_EXCEPTIONS,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Returns telegram API token
     *
     * @param null|int|string $storeId
     * @return mixed
     */
    public function getTelegramToken($storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::LOGGER_TELEGRAM_NOTIFICATION_TOKEN,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Returns telegram chat ID
     *
     * @param null|int|string $storeId
     * @return mixed
     */
    public function getTelegramChatId($storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::LOGGER_TELEGRAM_NOTIFICATION_CHAT_ID,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
}
