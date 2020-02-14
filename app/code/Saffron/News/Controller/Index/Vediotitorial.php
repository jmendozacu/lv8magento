<?php

namespace Saffron\News\Controller\Index;

class Vediotitorial extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
    $this->_view->loadLayout();
	

    echo $this->_view->getLayout()
                 ->createBlock("Saffron\News\Block\Index\Vediotitorial")
                 ->setTemplate("Saffron_News::news_index_vediotitorial.phtml")
                 ->toHtml();
   die;  
     
    }
}