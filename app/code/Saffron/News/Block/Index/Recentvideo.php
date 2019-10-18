<?php

namespace Saffron\News\Block\Index;


class Recentvideo extends \Magento\Framework\View\Element\Template {

    public function __construct(\Magento\Catalog\Block\Product\Context $context, array $data = []) {

        parent::__construct($context, $data);

    }


	

	
	
	/*public function getNewpostlist(){
		
		$id = $_GET['id'];
		$page=$_GET['page'];
		//print_r($id);die;
	$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
   	$newcategories = $objectManager->create('Saffron\News\Model\ResourceModel\Newspost\Collection')
			 ->addFieldToFilter('categories', array('eq' => $id))
			 ->addFieldToFilter('status', array('eq' => 0))
			 ->setPageSize($page) // only get 10 products 
             ->setCurPage(1) ;
			 //->setOrder('position', 'DESC');
	          

     if(count($newcategories)=='0'){
		 
		 $newcategories=[] ;
	 }
	 return   $newcategories  ;	
		
	}*/
	
	public function getNewsAllPost(){
	  $page= $_GET['page'];
     	
	$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
   	$newcategories = $objectManager->create('Saffron\News\Model\ResourceModel\Newspost\Collection')
			 ->addFieldToFilter('status', array('eq' => 0))
			  ->setPageSize($page) // only get 10 products 
             ->setCurPage(1) ;
	      return   $newcategories  ;	
		
	}
	
	
	public function getMediaurl(){
	
	
	$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
     $mediaurl = $objectManager->get('Magento\Store\Model\StoreManagerInterface')
                    ->getStore()
                    ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
					
		return  $mediaurl ;			
  }
    protected function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

}