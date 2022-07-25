<?php

namespace Alexandr\Store\Api;

use Magento\Framework\Data\SearchResultInterface;
use Alexandr\Store\Api\Data\StoreInterface;

interface StoreSearchResultInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Magento\Framework\Api\ExtensibleDataInterface[]
     */
    public function getItems();

    /**
     * @param array $items
     * @return StoreSearchResultInterface
     */
    public function setItems(array $items);
}
