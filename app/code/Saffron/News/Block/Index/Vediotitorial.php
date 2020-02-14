<?php

namespace Saffron\News\Block\Index;

class Vediotitorial extends \Magento\Framework\View\Element\Template{



public function getNewsvedio(){
		
	$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    $id  = $_GET['vediourl'];
	echo $id ;
	 if(!empty($id)){	
	  $newcategories = $objectManager->create('Saffron\News\Model\ResourceModel\Newspost\Collection')
			 ->addFieldToFilter('status', array('eq' => 0))
			 ->addFieldToFilter('featured', array('eq' => 2))
			 ->addFieldToFilter('id', array('eq' => $id))
			  ->setPageSize(1);
			 
	      return   $newcategories  ;	
		
		 }
	}


}