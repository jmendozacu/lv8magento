<?php
namespace Saffron\News\Block\Adminhtml\Newcategories\Edit;

/**
 * Admin page left menu
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('newcategories_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Newcategories Information'));
    }
}