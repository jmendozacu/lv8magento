<?php

namespace Saffron\News\Block\Index;


class Index extends \Magento\Framework\View\Element\Template {

    public function __construct(\Magento\Catalog\Block\Product\Context $context, array $data = []) {

        parent::__construct($context, $data);

    }


	
public function getNewcategories(){
		
	$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
   	$newcategories = $objectManager->create('Saffron\News\Model\ResourceModel\Newcategories\Collection')
			 ->addFieldToFilter('status', array('eq' => 0))
			 ->setOrder('position', 'DESC');
	          


	 return   $newcategories  ;	
		
	}
	
	
public function getNewsFeacture(){
		
	$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
   	$newcategories = $objectManager->create('Saffron\News\Model\ResourceModel\Newspost\Collection')
			 ->addFieldToFilter('status', array('eq' => 0))
			 ->addFieldToFilter('featured', array('eq' => 1))
			 ->setPageSize(8);
			 
	      return   $newcategories  ;	
		
	}
	

	
public function getNewsAllPost(){
		
	$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
   	$newcategories = $objectManager->create('Saffron\News\Model\ResourceModel\Newspost\Collection')
			 ->addFieldToFilter('status', array('eq' => 0));
			 
	      return   $newcategories  ;	
		
	}
	

public function getNewsvedio(){
		
	$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
   	$newcategories = $objectManager->create('Saffron\News\Model\ResourceModel\Newspost\Collection')
			 ->addFieldToFilter('status', array('eq' => 0))
			 ->addFieldToFilter('featured', array('eq' => 2))
			  ->setPageSize(8);
			 
	      return   $newcategories  ;	
		
	}
	

	
public function getMediaUrl(){
	$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
  $mediaUrl =  $objectManager->get('Magento\Store\Model\StoreManagerInterface')
                    ->getStore()
                    ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
	return   $mediaUrl;
}	
	
    protected function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

}