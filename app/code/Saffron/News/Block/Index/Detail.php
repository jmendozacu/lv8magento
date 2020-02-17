<?php

namespace Saffron\News\Block\Index;


class Detail extends \Magento\Framework\View\Element\Template {

    public function __construct(\Magento\Catalog\Block\Product\Context $context, array $data = []) {

        parent::__construct($context, $data);

    }


	
	protected function _prepareLayout()
    {
		
	//$new_id  = $_GET['id'];
	$new_id  = $this->getRequest()->getParam('post');
	if(!empty($new_id)){
	$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
   	$newcategories = $objectManager->create('Saffron\News\Model\ResourceModel\Newspost\Collection')
			 ->addFieldToFilter('status', array('eq' => 0))
			 ->addFieldToFilter('url_key', array('eq' => $new_id));
			 $newcategories = $newcategories->getData();
	}
		
		$this->pageConfig->getTitle()->set($newcategories[0]['post_title'] );
        //$this->pageConfig->setKeywords($category->getMetaKeywords());
        //$this->pageConfig->setDescription($category->getMetaDescription());
        return parent::_prepareLayout();
    }
	
public function getNewsDetail(){
	//$new_id  = $_GET['id'];
	$new_id  = $this->getRequest()->getParam('post');
	$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
   	$newcategories = $objectManager->create('Saffron\News\Model\ResourceModel\Newspost\Collection')
			 ->addFieldToFilter('status', array('eq' => 0))
			 ->addFieldToFilter('url_key', array('eq' => $new_id));
			 
	      return   $newcategories  ;	
		
	}
	
public function getMediaUrl(){
	$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
  $mediaUrl =  $objectManager->get('Magento\Store\Model\StoreManagerInterface')
                    ->getStore()
                    ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
	return   $mediaUrl;
}		
	
    

}