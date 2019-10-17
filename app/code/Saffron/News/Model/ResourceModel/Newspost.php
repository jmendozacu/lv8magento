<?php
namespace Saffron\News\Model\ResourceModel;

class Newspost extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('newspost', 'id');
    }
}
?>