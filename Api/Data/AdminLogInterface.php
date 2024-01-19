<?php

namespace Bydn\Logger\Api\Data;

/**
 * Interface AdminLogInterface
 */
interface AdminLogInterface
{
    public const ID = 'ID';
    public const USER_ID = 'user_id';
    public const USER_MAIL = 'user_mail';
    public const USER_NAME = 'user_name';
    public const USER_IP = 'user_ip';
    public const CONTROLLER_MODULE = 'controller_module';
    public const CONTROLLER_NAME = 'controller_name';
    public const ACTION_NAME = 'action_name';
    public const PARAMS = 'params';
    public const CREATED_AT = 'created_at';

    /**
     * Returns entity ID
     *
     * @return null|int
     */
    public function getId(): ?int;

    /**
     * Returns User Id
     *
     * @return null|int
     */
    public function getUserId(): ?int;

    /**
     * Returns User Email
     *
     * @return string|null
     */
    public function getUserEmail(): ?string;

    /**
     * Returns User Name
     *
     * @return string|null
     */
    public function getUserName(): ?string;

    /**
     * Returns User IP
     *
     * @return string|null
     */
    public function getUserIp(): ?string;

    /**
     * Returns Module Name
     *
     * @return string|null
     */
    public function getControllerModule(): ?string;

    /**
     * Returns Controller Name
     *
     * @return string|null
     */
    public function getControllerName(): ?string;

    /**
     * Returns Action Name
     *
     * @return string|null
     */
    public function getActionName(): ?string;

    /**
     * Returns Request Parameters
     *
     * @return string|null
     */
    public function getParams(): ?string;

    /**
     * Returns Creation Date
     *
     * @return string|null
     */
    public function getCreatedAt(): ?string;

    /**
     * Sets the User ID
     *
     * @param int $userId
     * @return AdminLogInterface
     */
    public function setUserId(int $userId): AdminLogInterface;

    /**
     * Sets the User Email
     *
     * @param string $userEmail
     * @return AdminLogInterface
     */
    public function setUserEmail(string $userEmail): AdminLogInterface;

    /**
     * Sets the User Name
     *
     * @param string $userName
     * @return AdminLogInterface
     */
    public function setUserName(string $userName): AdminLogInterface;

    /**
     * Sets the User IP
     *
     * @param string $userIp
     * @return AdminLogInterface
     */
    public function setUserIp(string $userIp): AdminLogInterface;

    /**
     * Sets the Module Name
     *
     * @param string $controllerModule
     * @return AdminLogInterface
     */
    public function setControllerModule(string $controllerModule): AdminLogInterface;

    /**
     * Sets the Controller Name
     *
     * @param string $controllerName
     * @return AdminLogInterface
     */
    public function setControllerName(string $controllerName): AdminLogInterface;

    /**
     * Sets the Action Name
     *
     * @param string $actionName
     * @return AdminLogInterface
     */
    public function setActionName(string $actionName): AdminLogInterface;

    /**
     * Sets the Request Paramters
     *
     * @param string $params
     * @return AdminLogInterface
     */
    public function setParams(string $params): AdminLogInterface;

    /**
     * Sets the Creation Date
     *
     * @param string $createdAt
     * @return AdminLogInterface
     */
    public function setCreatedAt(string $createdAt): AdminLogInterface;
}
