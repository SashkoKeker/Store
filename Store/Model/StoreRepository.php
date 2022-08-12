<?php

namespace Alexandr\Store\Model;

use Alexandr\Store\Api\Data\StoreInterface;
use Alexandr\Store\Api\StoreRepositoryInterface;
use Alexandr\Store\Api\StoreSearchResultInterface;
use Alexandr\Store\Api\Data\StoreInterfaceFactory;
use Alexandr\Store\Model\ResourceModel\Store\CollectionFactory;
use Alexandr\Store\Model\ResourceModel\Store as StoreResource;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Alexandr\Store\Model\StoreFactory;
use Alexandr\Store\Api\StoreSearchResultInterfaceFactory;
use Magento\Framework\Exception\StateException;
use Magento\Framework\Event\ManagerInterface as EventManager;


class StoreRepository implements StoreRepositoryInterface
{
    /**
     * @var CollectionFactory
     */
    private CollectionFactory $collectionFactory;
    /**
     * @var StoreResource
     */
    private StoreResource $storeResource;
    /**
     * @var StoreInterfaceFactory
     */
    private $storeFactory;
    /**
     * @var StoreSearchResultInterfaceFactory
     */
    private StoreSearchResultInterfaceFactory $searchResultInterfaceFactory;
    /**
     * @var EventManager
     */
    private $eventManager;

    public function __construct(
        StoreFactory $storeFactory,
        CollectionFactory $collectionFactory,
        StoreResource  $storeResource,
        StoreSearchResultInterfaceFactory $searchResultInterfaceFactory,
        EventManager $eventManager
    ) {
        $this->storeFactory = $storeFactory;
        $this->collectionFactory = $collectionFactory;
        $this->storeResource = $storeResource;
        $this->searchResultInterfaceFactory = $searchResultInterfaceFactory;
        $this->eventManager = $eventManager;
    }

    public function get(int $id, int $storeView_id = null): StoreInterface
    {
        $store = $this->storeFactory->create();
        $this->storeResource->load($store, $id);
        return $store;
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
        $this->eventManager->dispatch('store_store_save_before', ['store' => $store]);
        $this->storeResource->save($store);
        return $store;
    }

    public function delete(StoreInterface $store) : void
    {
        $this->storeResource->delete($store);
    }

    public function deleteById(int $store_id): void
    {
        $store = $this->get($store_id);
        $this->delete($store);
    }

    /**
     * @param string $urlKey
     * @return StoreInterface
     */
    public function getByUrlKey(string $urlKey): StoreInterface
    {
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter(StoreInterface::STORE_URL_KEY , $urlKey);
        return $collection->getLastItem();
    }

}
