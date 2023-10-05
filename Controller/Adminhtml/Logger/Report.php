<?php

namespace Bydn\Logger\Controller\Adminhtml\Logger;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\Page;

/**
 * Class Render
 */
class Report extends Action
{
    const MENU_ID = 'Bydn_Logger::report_logger_report';
    const ADMIN_RESOURCE = 'Bydn_Logger::report_logger_report';

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
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|Page
     */
    public function execute() {
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu(static::MENU_ID);
        $resultPage->getConfig()->getTitle()->prepend('Admin Logger');
        return $resultPage;
    }

}
