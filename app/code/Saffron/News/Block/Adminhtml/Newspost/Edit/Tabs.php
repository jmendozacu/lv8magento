<?php
namespace Saffron\News\Block\Adminhtml\Newspost\Edit;

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
        $this->setId('newspost_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Newspost Information'));
    }
}