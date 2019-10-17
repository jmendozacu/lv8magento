<?php

namespace Saffron\News\Controller\Index;

class Recent extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {

	
	
    echo $this->_view->getLayout()
                 ->createBlock("Saffron\News\Block\Index\Recent")
                 ->setTemplate("Saffron_News::news_index_recent.phtml")
                 ->toHtml();
	
        die;
    }
}