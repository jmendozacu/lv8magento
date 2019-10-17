<?php

namespace Saffron\News\Controller\Adminhtml\newspost;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPagee;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return void
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Saffron_News::newspost');
        $resultPage->addBreadcrumb(__('Saffron'), __('Saffron'));
        $resultPage->addBreadcrumb(__('Manage item'), __('Manage Newspost'));
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Newspost'));

        return $resultPage;
    }
}
?>