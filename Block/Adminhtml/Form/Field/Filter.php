<?php

namespace Bydn\AdminLogger\Block\Adminhtml\Form\Field;

use Magento\CatalogInventory\Block\Adminhtml\Form\Field\Customergroup;

class Filter extends \Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray
{
    private $filterTypeRenderer;

    /**
     * {@inheritdoc}
     */
    protected function _prepareToRender()
    {
        $this->addColumn(
            'filter_type',
            [
                'label' => __('Filter type'),
                'class' => 'required-entry',
                'renderer' => $this->getFilterTypeRenderer()
            ]
        );
        $this->addColumn(
            'value',
            [
                'label' => __('Value'),
                'class' => 'required-entry'
            ]
        );
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add Filter');
    }

    protected function getFilterTypeRenderer()
    {
        if (!$this->filterTypeRenderer) {
            $this->filterTypeRenderer = $this->getLayout()->createBlock(
                \Bydn\AdminLogger\Block\Adminhtml\Form\Field\Type::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            );
            $this->filterTypeRenderer->setClass('customer_group_select admin__control-select');
        }
        return $this->filterTypeRenderer;
    }

    /**
     * Prepare existing row data object
     *
     * @param \Magento\Framework\DataObject $row
     * @return void
     */
    protected function _prepareArrayRow(\Magento\Framework\DataObject $row)
    {
        $optionExtraAttr = [];
        $optionExtraAttr['option_' . $this->getFilterTypeRenderer()->calcOptionHash($row->getData('filter_type'))] =
            'selected="selected"';
        $optionExtraAttr['option_' . $this->getFilterTypeRenderer()->calcOptionHash($row->getData('value'))] =
            'selected="selected"';
        $row->setData(
            'option_extra_attrs',
            $optionExtraAttr
        );
    }

    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $html = parent::_getElementHtml($element);

//        $script = '<script type="text/javascript">
//                require(["jquery", "jquery/ui", "mage/calendar"], function ($) {
//                    $(function(){
//                        function bindDatePicker() {
//                            setTimeout(function() {
//                                $(".appointment-slot").datepicker( { dateFormat: "yy/mm/dd" } );
//                            }, 50);
//                        }
//                        bindDatePicker();
//                        $("button.action-add").on("click", function(e) {
//                            bindDatePicker();
//                        });
//                    });
//                });
//            </script>';
//        $html .= $script;

        return $html;
    }
}
