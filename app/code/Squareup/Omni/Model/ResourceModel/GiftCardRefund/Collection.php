<?php
/**
 * SquareUp
 *
 * GiftCard Collection Model
 *
 * @category    Squareup
 * @package     Squareup_Omni
 * @copyright   2018
 * @author      SquareUp
 */

namespace Squareup\Omni\Model\ResourceModel\GiftCardRefund;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 */
class Collection extends AbstractCollection
{
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            \Squareup\Omni\Model\GiftCardRefund::class,
            \Squareup\Omni\Model\ResourceModel\GiftCardRefund::class
        );
    }
}
