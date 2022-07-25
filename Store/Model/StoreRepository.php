<?php

namespace Alexandr\Store\Model;

use Alexandr\Store\Api\Data\StoreInterface;
use Alexandr\Store\Api\StoreRepositoryInterface;
use Alexandr\Store\Api\StoreSearchResultInterface;
use Alexandr\Store\Model\ResourceModel\Store\CollectionFactory;
use Alexandr\Store\Model\ResourceModel\Store as StoreResource;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Alexandr\Store\Model\StoreFactory;
use Alexandr\Store\Api\StoreSearchResultInterfaceFactory;
use Magento\Framework\Exception\StateException;


class StoreRepository implements StoreRepositoryInterface
{
    private CollectionFactory $collectionFactory;
    private StoreResource $storeResource;
    private StoreFactory $storeFactory;
    private StoreSearchResultInterfaceFactory $searchResultInterfaceFactory;

    public function __construct(
        StoreFactory $storeFactory,
        CollectionFactory $collectionFactory,
        StoreResource  $storeResource,
        StoreSearchResultInterfaceFactory $searchResultInterfaceFactory
    ) {
        $this->storeFactory = $storeFactory;
        $this->collectionFactory = $collectionFactory;
        $this->storeResource = $storeResource;
        $this->searchResultInterfaceFactory = $searchResultInterfaceFactory;
    }


    public function get(int $id): StoreInterface
    {
        $object = $this->storeFactory->create();
        $this->storeResource->load($object, $id);
        if (! $object->getId()) {
            throw new NoSuchEntityException(__('Unable to find entity with ID "%1"', $id));
        }
        return $object;
    }


    public function getList(SearchCriteriaInterface $searchCriteria): StoreSearchResultInterface
    {
        $collection = $this->collectionFactory->create();
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                $condition = $filter->getConditionType() ? $filter->getConditionType() : 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }

        $searchResult = $this->searchResultInterfaceFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());
        return $searchResult;

    }

    /**
     * @param StoreInterface $store
     * @return StoreInterface
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function save(StoreInterface $store): StoreInterface
    {
        $this->storeResource->save($store);
        return $store;

    }

    public function delete(StoreInterface $workingHours): bool
    {
        try {
            $this->storeResource->delete($workingHours);
        } catch (\Exception $e) {
            throw new StateException(__('Unable to remove entity #%1', $workingHours->getId()));
        }
        return true;

    }
}
