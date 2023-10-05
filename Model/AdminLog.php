<?php

namespace Bydn\Logger\Model;

use Bydn\Logger\Api\Data\AdminLogInterface;
use Magento\Framework\Model\AbstractExtensibleModel;

class AdminLog extends AbstractExtensibleModel implements AdminLogInterface
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Bydn\Logger\Model\ResourceModel\AdminLog::class);
        $this->setIdFieldName('id');
    }

    /**
     * @return null|int
     */
    public function getId(): ?int
    {
        return $this->getData(self::ID);
    }

    /**
     * @return null|int
     */
    public function getUserId(): ?int
    {
        return $this->getData(self::USER_ID);
    }

    /**
     * @return string|null
     */
    public function getUserEmail(): ?string
    {
        return $this->getData(self::USER_MAIL);
    }

    /**
     * @return string|null
     */
    public function getUserName(): ?string
    {
        return $this->getData(self::USER_NAME);
    }

    /**
     * @return string|null
     */
    public function getUserIp(): ?string
    {
        return $this->getData(self::USER_IP);
    }

    /**
     * @return string|null
     */
    public function getControllerModule(): ?string
    {
        return $this->getData(self::CONTROLLER_MODULE);
    }

    /**
     * @return string|null
     */
    public function getControllerName(): ?string
    {
        return $this->getData(self::CONTROLLER_NAME);
    }

    /**
     * @return string|null
     */
    public function getActionName(): ?string
    {
        return $this->getData(self::ACTION_NAME);
    }

    /**
     * @return string|null
     */
    public function getParams(): ?string
    {
        return $this->getData(self::PARAMS);
    }

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @param int $userId
     * @return AdminLogInterface
     */
    public function setUserId(int $userId): AdminLogInterface
    {
        return $this->setData(self::USER_ID, $userId);
    }

    /**
     * @param string $userEmail
     * @return AdminLogInterface
     */
    public function setUserEmail(string $userEmail): AdminLogInterface
    {
        return $this->setData(self::USER_MAIL, $userEmail);
    }

    /**
     * @param string $userName
     * @return AdminLogInterface
     */
    public function setUserName(string $userName): AdminLogInterface
    {
        return $this->setData(self::USER_NAME, $userName);
    }

    /**
     * @param string $userIp
     * @return AdminLogInterface
     */
    public function setUserIp(string $userIp): AdminLogInterface
    {
        return $this->setData(self::USER_IP, $userIp);
    }

    /**
     * @param string $controllerModule
     * @return AdminLogInterface
     */
    public function setControllerModule(string $controllerModule): AdminLogInterface
    {
        return $this->setData(self::CONTROLLER_MODULE, $controllerModule);
    }

    /**
     * @param string $controllerName
     * @return AdminLogInterface
     */
    public function setControllerName(string $controllerName): AdminLogInterface
    {
        return $this->setData(self::CONTROLLER_NAME, $controllerName);
    }

    /**
     * @param string $actionName
     * @return AdminLogInterface
     */
    public function setActionName(string $actionName): AdminLogInterface
    {
        return $this->setData(self::ACTION_NAME, $actionName);
    }

    /**
     * @param string $params
     * @return AdminLogInterface
     */
    public function setParams(string $params): AdminLogInterface
    {
        return $this->setData(self::PARAMS, $params);
    }

    /**
     * @param string $createdAt
     * @return AdminLogInterface
     */
    public function setCreatedAt(string $createdAt): AdminLogInterface
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }
}
