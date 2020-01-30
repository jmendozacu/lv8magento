<?php

namespace Saffron\News\Controller\Index;

class Recentvideo extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {

	
	
    echo $this->_view->getLayout()
                 ->createBlock("Saffron\News\Block\Index\Recentvideo")
                 ->setTemplate("Saffron_News::news_index_recentvideo.phtml")
                 ->toHtml();
	
        die;
    }
}