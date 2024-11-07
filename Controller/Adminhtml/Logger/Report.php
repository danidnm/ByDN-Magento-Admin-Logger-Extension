<?php

namespace Bydn\AdminLogger\Controller\Adminhtml\Logger;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\Page;

/**
 * Class Render
 */
class Report extends Action
{
    public const MENU_ID = 'Bydn_AdminLogger::report_logger_report';
    public const ADMIN_RESOURCE = 'Bydn_AdminLogger::report_logger_report';

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;

    /**
     * @param \Magento\Framework\View\Result\PageFactory $_resultPageFactory
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\View\Result\PageFactory $_resultPageFactory,
        \Magento\Backend\App\Action\Context $context
    ) {
        parent::__construct($context);
        $this->_resultPageFactory = $_resultPageFactory;
    }

    /**
     * Executes the controller
     *
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|Page
     */
    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu(static::MENU_ID);
        $resultPage->getConfig()->getTitle()->prepend('Admin Logger');
        return $resultPage;
    }
}
