<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Saffron\Theme\Block\Html;


class Topmenu extends \Magento\Theme\Block\Html\Topmenu
{
    
	
	
   public function getCostommenu(){
		
		return 'ddepak';
	}
	
	public function getCategrieslogo(){
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $category = $objectManager->get('Magento\Framework\Registry')->registry('current_category');//get current category
  
		$category = $category;
		return $category;
	}
	public function getInnerlogo($id){
	    $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $subcategory = $objectManager->create('Magento\Catalog\Model\Category')->load($id);           
        $alldate = $subcategory->getData();
		return $alldate['innerlogo'];
	}
		
 public function getMedia(){
	$_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
	$storeManager = $_objectManager->get('Magento\Store\Model\StoreManagerInterface'); 
	$currentStore = $storeManager->getStore();
	$mediaUrl = $currentStore->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
     
	  return $mediaUrl ;
	}
}
