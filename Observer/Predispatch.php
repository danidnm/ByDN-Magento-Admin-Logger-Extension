<?php

namespace Bydn\AdminLogger\Observer;

use Bydn\AdminLogger\Api\Data\AdminLogInterface;

class Predispatch implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var \Magento\Backend\Model\Auth\Session
     */
    private $authSession;

    /**
     * @var \Magento\Framework\Serialize\Serializer\Json
     */
    private $jsonSerializer;

    /**
     * @var \Bydn\AdminLogger\Helper\Config
     */
    private $loggerConfig;

    /**
     * @var \Bydn\AdminLogger\Model\ResourceModel\AdminLog
     */
    private $adminLogResource;

    /**
     * @var \Bydn\AdminLogger\Model\AdminLogFactory
     */
    private \Bydn\AdminLogger\Model\AdminLogFactory $adminLogFactory;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * @var \Magento\Framework\App\Request\Http
     */
    private $request;

    /**
     * @param \Magento\Backend\Model\Auth\Session $authSession
     * @param \Magento\Framework\Serialize\Serializer\Json $jsonSerializer
     * @param \Bydn\AdminLogger\Model\ResourceModel\AdminLog $adminLogResource
     * @param \Bydn\AdminLogger\Model\AdminLogFactory $adminLogFactory
     * @param \Bydn\AdminLogger\Helper\Config $loggerConfig
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Magento\Backend\Model\Auth\Session $authSession,
        \Magento\Framework\Serialize\Serializer\Json $jsonSerializer,
        \Bydn\AdminLogger\Model\ResourceModel\AdminLog $adminLogResource,
        \Bydn\AdminLogger\Model\AdminLogFactory $adminLogFactory,
        \Bydn\AdminLogger\Helper\Config $loggerConfig,
        \Psr\Log\LoggerInterface $logger
    )
    {
        $this->authSession = $authSession;
        $this->jsonSerializer = $jsonSerializer;
        $this->adminLogResource = $adminLogResource;
        $this->adminLogFactory = $adminLogFactory;
        $this->loggerConfig = $loggerConfig;
        $this->logger = $logger;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        // Check admin logger is enabled
        if (!$this->loggerConfig->isAdminLoggerEnabled()) {
            return;
        }

        // Extract request
        $this->request = $observer->getData('request');

        // New log entry
        $adminLog = $this->adminLogFactory->create();

        // Controller data
        $adminLog->setControllerModule($this->request->getControllerModule() ?: '');
        $adminLog->setControllerName($this->request->getControllerName() ?: '');
        $adminLog->setActionName($this->request->getActionName() ?: '');
        $adminLog->setUserIp($this->request->getClientIp() ?: '');

        // Skip Magento_Ui
        if ($adminLog->getControllerModule() == 'Magento_Ui') {
            return;
        }

        // User data if exists
        $user = $this->authSession->getUser();
        if ($user && $user->getId()) {
            $adminLog->setUserId($user->getId());
            $adminLog->setUserName($user->getUserName());
            $adminLog->setUserEmail($user->getEmail());
        }

        // Request parameters
        $params = $this->collectRequestParams();
        $params = json_encode($params);
        $adminLog->setParams($params);

        // Save log entry
        $this->adminLogResource->save($adminLog);
    }

    /**
     * @return array
     */
    private function collectRequestParams()
    {
        // Request parameters
        $params = $this->request->getParams();

        // Process and remove some parameters
        if (!empty($params)) {

            // Remove keys, uenc and tokens
            unset($params['key']);
            unset($params['token']);
            unset($params['uenc']);

            // Remove passwords
            if (isset($params['login']['password'])) {
                $params['login']['password'] = '***';
            }
        }

        return $params;
    }
}
