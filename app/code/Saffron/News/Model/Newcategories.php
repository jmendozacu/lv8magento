<?php
namespace Saffron\News\Model;

class Newcategories extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Saffron\News\Model\ResourceModel\Newcategories');
    }
}
?>