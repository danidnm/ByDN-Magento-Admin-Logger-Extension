<?php

namespace Bydn\AdminLogger\Model;

use Bydn\AdminLogger\Api\Data\AdminLogInterface;
use Magento\Framework\Model\AbstractExtensibleModel;

class AdminLog extends AbstractExtensibleModel implements AdminLogInterface
{
    /**
     * Class constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Bydn\AdminLogger\Model\ResourceModel\AdminLog::class);
        $this->setIdFieldName('id');
    }

    /**
     * Returns the entity ID
     *
     * @return null|int
     */
    public function getId(): ?int
    {
        return $this->getData(self::ID);
    }

    /**
     * Returns the User ID
     *
     * @return null|int
     */
    public function getUserId(): ?int
    {
        return $this->getData(self::USER_ID);
    }

    /**
     * Returns the User Email
     *
     * @return string|null
     */
    public function getUserEmail(): ?string
    {
        return $this->getData(self::USER_MAIL);
    }

    /**
     * Returns the User Name
     *
     * @return string|null
     */
    public function getUserName(): ?string
    {
        return $this->getData(self::USER_NAME);
    }

    /**
     * Returns the User IP
     *
     * @return string|null
     */
    public function getUserIp(): ?string
    {
        return $this->getData(self::USER_IP);
    }

    /**
     * Returns the Module Name
     *
     * @return string|null
     */
    public function getControllerModule(): ?string
    {
        return $this->getData(self::CONTROLLER_MODULE);
    }

    /**
     * Returns the Controller Name
     *
     * @return string|null
     */
    public function getControllerName(): ?string
    {
        return $this->getData(self::CONTROLLER_NAME);
    }

    /**
     * Returns the Action Name
     *
     * @return string|null
     */
    public function getActionName(): ?string
    {
        return $this->getData(self::ACTION_NAME);
    }

    /**
     * Returns the Request Parameters
     *
     * @return string|null
     */
    public function getParams(): ?string
    {
        return $this->getData(self::PARAMS);
    }

    /**
     * Returns the Creation date
     *
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Sets the User Id
     *
     * @param int $userId
     * @return AdminLogInterface
     */
    public function setUserId(int $userId): AdminLogInterface
    {
        return $this->setData(self::USER_ID, $userId);
    }

    /**
     * Sets the User Email
     *
     * @param string $userEmail
     * @return AdminLogInterface
     */
    public function setUserEmail(string $userEmail): AdminLogInterface
    {
        return $this->setData(self::USER_MAIL, $userEmail);
    }

    /**
     * Sets the User Name
     *
     * @param string $userName
     * @return AdminLogInterface
     */
    public function setUserName(string $userName): AdminLogInterface
    {
        return $this->setData(self::USER_NAME, $userName);
    }

    /**
     * Sets the User IP
     *
     * @param string $userIp
     * @return AdminLogInterface
     */
    public function setUserIp(string $userIp): AdminLogInterface
    {
        return $this->setData(self::USER_IP, $userIp);
    }

    /**
     * Sets the Module Name
     *
     * @param string $controllerModule
     * @return AdminLogInterface
     */
    public function setControllerModule(string $controllerModule): AdminLogInterface
    {
        return $this->setData(self::CONTROLLER_MODULE, $controllerModule);
    }

    /**
     * Sets the Controller Name
     *
     * @param string $controllerName
     * @return AdminLogInterface
     */
    public function setControllerName(string $controllerName): AdminLogInterface
    {
        return $this->setData(self::CONTROLLER_NAME, $controllerName);
    }

    /**
     * Sets the Action Name
     *
     * @param string $actionName
     * @return AdminLogInterface
     */
    public function setActionName(string $actionName): AdminLogInterface
    {
        return $this->setData(self::ACTION_NAME, $actionName);
    }

    /**
     * Sets the Request Parameters
     *
     * @param string $params
     * @return AdminLogInterface
     */
    public function setParams(string $params): AdminLogInterface
    {
        return $this->setData(self::PARAMS, $params);
    }

    /**
     * Sets the Creation Date
     *
     * @param string $createdAt
     * @return AdminLogInterface
     */
    public function setCreatedAt(string $createdAt): AdminLogInterface
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }
}
