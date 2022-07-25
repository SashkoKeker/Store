<?php


namespace Alexandr\Store\Model\ResourceModel;

use Alexandr\Store\Api\Data\StoreInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;

class Store extends AbstractDb
{
    public const TABLE_NAME = 'alexandr_store';

    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, StoreInterface::ID);
    }

}
