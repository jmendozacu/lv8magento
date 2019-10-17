<?php

namespace Saffron\News\Model\ResourceModel\Newcategories;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Saffron\News\Model\Newcategories', 'Saffron\News\Model\ResourceModel\Newcategories');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>