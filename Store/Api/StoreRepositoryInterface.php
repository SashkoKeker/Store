<?php

namespace Alexandr\Store\Api;



use Alexandr\Store\Api\Data\StoreInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface StoreRepositoryInterface
{
    /**
     * @param int $id
     * @return StoreInterface
     */
    public function get(int $id): StoreInterface;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return StoreSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): StoreSearchResultInterface;

    /**
     * @param StoreInterface $store
     * @return StoreInterface
     */
    public function save(StoreInterface $store): StoreInterface;

    /**
     * @param StoreInterface $workingHours
     * @return bool
     */
    public function delete(StoreInterface $workingHours): bool;

}
