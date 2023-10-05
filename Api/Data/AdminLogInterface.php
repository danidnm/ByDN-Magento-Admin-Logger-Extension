<?php

namespace Bydn\Logger\Api\Data;

/**
 * Interface AdminLogInterface
 */
interface AdminLogInterface
{
    const ID = 'ID';
    const USER_ID = 'user_id';
    const USER_MAIL = 'user_mail';
    const USER_NAME = 'user_name';
    const USER_IP = 'user_ip';
    const CONTROLLER_MODULE = 'controller_module';
    const CONTROLLER_NAME = 'controller_name';
    const ACTION_NAME = 'action_name';
    const PARAMS = 'params';
    const CREATED_AT = 'created_at';

    /**
     * @return null|int
     */
    public function getId(): ?int;

    /**
     * @return null|int
     */
    public function getUserId(): ?int;

    /**
     * @return string|null
     */
    public function getUserEmail(): ?string;

    /**
     * @return string|null
     */
    public function getUserName(): ?string;

    /**
     * @return string|null
     */
    public function getUserIp(): ?string;

    /**
     * @return string|null
     */
    public function getControllerModule(): ?string;

    /**
     * @return string|null
     */
    public function getControllerName(): ?string;

    /**
     * @return string|null
     */
    public function getActionName(): ?string;

    /**
     * @return string|null
     */
    public function getParams(): ?string;

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string;

    /**
     * @param int $userId
     * @return AdminLogInterface
     */
    public function setUserId(int $userId): AdminLogInterface;

    /**
     * @param string $userEmail
     * @return AdminLogInterface
     */
    public function setUserEmail(string $userEmail): AdminLogInterface;

    /**
     * @param string $userName
     * @return AdminLogInterface
     */
    public function setUserName(string $userName): AdminLogInterface;

    /**
     * @param string $userIp
     * @return AdminLogInterface
     */
    public function setUserIp(string $userIp): AdminLogInterface;

    /**
     * @param string $controllerModule
     * @return AdminLogInterface
     */
    public function setControllerModule(string $controllerModule): AdminLogInterface;

    /**
     * @param string $controllerName
     * @return AdminLogInterface
     */
    public function setControllerName(string $controllerName): AdminLogInterface;

    /**
     * @param string $actionName
     * @return AdminLogInterface
     */
    public function setActionName(string $actionName): AdminLogInterface;

    /**
     * @param string $params
     * @return AdminLogInterface
     */
    public function setParams(string $params): AdminLogInterface;

    /**
     * @param string $createdAt
     * @return AdminLogInterface
     */
    public function setCreatedAt(string $createdAt): AdminLogInterface;
}
