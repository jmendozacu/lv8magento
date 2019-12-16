<?php

namespace Saffron\Shipping\Model\Carrier;

use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Shipping\Model\Rate\Result;

class Shippingcost extends \Magento\Shipping\Model\Carrier\AbstractCarrier implements
    \Magento\Shipping\Model\Carrier\CarrierInterface
{
    /**
     * @var string
     */
    protected $_code = 'shippingcost';

    /**
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory
     * @param \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory,
        \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory,
        array $data = []
    ) {
        $this->_rateResultFactory = $rateResultFactory;
        $this->_rateMethodFactory = $rateMethodFactory;
        parent::__construct($scopeConfig, $rateErrorFactory, $logger, $data);
    }

    /**
     * @return array
     */
    public function getAllowedMethods()
    {
        return ['shippingcost' => $this->getConfigData('name')];
    }

    /**
     * @param RateRequest $request
     * @return bool|Result
     */
    public function collectRates(RateRequest $request)
    {
        if (!$this->getConfigFlag('active')) {
            return false;
        }

        /** @var \Magento\Shipping\Model\Rate\Result $result */
        $result = $this->_rateResultFactory->create();

        /** @var \Magento\Quote\Model\Quote\Address\RateResult\Method $method */
        $method = $this->_rateMethodFactory->create();

        $method->setCarrier('shippingcost');
		
		$amount = $this->Shippingrangeprice();
		
		if($amount =='0.00'){
	    $method->setCarrierTitle('Free');
        $method->setMethod('shippingcost');
        $method->setMethodTitle('Free Shipping');
		}else{
		$method->setCarrierTitle($this->getConfigData('title'));
        $method->setMethod('shippingcost');
        $method->setMethodTitle($this->getConfigData('name'));	
			
		}
	    /*you can fetch shipping price from different sources over some APIs, we used price from config.xml - xml node price*/
        //$amount = $this->getConfigData('price');

        $method->setPrice($amount);
        $method->setCost($amount);

        $result->append($method);

        return $result;
    }
	
	
	
	
public function Shippingrangeprice(){
	$objectManager = \Magento\Framework\App\ObjectManager::getInstance(); 
	$quoteId = $objectManager->create('Magento\Checkout\Model\Session')->getQuoteId(); 
	$cart = $objectManager->get('\Magento\Checkout\Model\Cart'); 
	$itemsCollection = $cart->getQuote()->getItemsCollection();
	$itemsVisible = $cart->getQuote()->getAllVisibleItems();
	$items = $cart->getQuote()->getAllItems();
	$qty_item = $totalQuantity = $cart->getQuote()->getItemsQty();
	$subTotal = $cart->getQuote()->getSubtotal();
	
	
	if(('0.00' < $subTotal)&&($subTotal <= '99.99') ){
		$pricerang = '10.00';
	//}else if(('21.00' <= $subTotal)&& ($subTotal <= '39.99')){
		//$pricerang ='7.95';
	//}else if(('40.00' <= $subTotal)&& ($subTotal <= '48.99')){
		//$pricerang = '9.95';
	}else{
	$pricerang = '0.00';	
	}
	
	 return  $pricerang;
			
}


}