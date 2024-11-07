<?php

namespace Bydn\AdminLogger\Block\Adminhtml\Form\Field;

use Magento\Framework\View\Element\Html\Select;
use Magento\Backend\Block\Template\Context;

class Type extends Select
{
    public const TYPE_MODULE = 1;
    public const TYPE_CONTROLLER_MODULE = 2;
    public const TYPE_CONTROLLER_NAME = 3;
    public const TYPE_ACTION_NAME = 4;
    public const TYPE_USER = 5;

    /**
     * CustomColumn constructor.
     *
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setInputName($value)
    {
        return $this->setName($value);
    }

    /**
     * Render HTML
     *
     * @return string
     */
    public function _toHtml(): string
    {
        if (!$this->getOptions()) {
            $this->setOptions($this->getSourceOptions());
        }
        return parent::_toHtml();
    }

    /**
     * Get all the groups as options and add the guest group
     *
     * @return array
     */
    private function getSourceOptions(): array
    {
        return [
            ['value' => self::TYPE_MODULE, 'label' => __('Module name (ie. Bydn_AdminLogger')],
            ['value' => self::TYPE_CONTROLLER_MODULE, 'label' => __('Controller module')],
            ['value' => self::TYPE_CONTROLLER_NAME, 'label' => __('Controller name')],
            ['value' => self::TYPE_ACTION_NAME, 'label' => __('Action name')],
            ['value' => self::TYPE_USER, 'label' => __('User name')],
        ];
    }
}

