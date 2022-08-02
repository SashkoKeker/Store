<?php

namespace Alexandr\Store\UI\DataProvider;

use Alexandr\Store\Model\ResourceModel\Store\Collection;
use Alexandr\Store\Model\ResourceModel\Store\CollectionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Magento\Ui\DataProvider\ModifierPoolDataProvider;


class StoreDataProvider extends ModifierPoolDataProvider
{
    protected $collection;

    private $loadedData = [];

    private $storeManager;

    private $request;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        StoreManagerInterface $storeManager,
        RequestInterface $request,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->storeManager = $storeManager;
        $this->request = $request;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData() :array
    {
        if (!empty($this->loadedData)) {
            return $this->loadedData;
        }
        $storeId = $this->request->getParam('store', 0);
        $mediaUrl = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);

        $items = $this->collection->getItems();
        foreach ($items as $store) {
            if ($store->getImage()) {
                $store->setImage([
                    [
                        'name' => $store->getImage(),
                        'url' => $mediaUrl . 'store/base_path/' . $store->getImage()
                    ]
                ]);
            }
            $name = $store->getName();
            if ($name == 'WARNING: No set name for this store view') {
                $store->setName("");
            } else {
                $store->setName($name);
            }
            $store->setData('store_view_id', $storeId);
            $this->loadedData[$store->getId()] = $store->getData();
        }
        return $this->loadedData;
    }
}
