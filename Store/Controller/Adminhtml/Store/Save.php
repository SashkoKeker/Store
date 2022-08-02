<?php

namespace Alexandr\Store\Controller\Adminhtml\Store;

use Alexandr\Store\Api\Data\StoreInterface;
use Alexandr\Store\Api\Data\StoreInterfaceFactory;
use Alexandr\Store\Api\StoreRepositoryInterface;
//use Alexandr\Store\Api\Data\StoreAttributeInterfaceFactory;
//use Alexandr\Store\Api\StoreAttributeRepositoryInterface;

use Magento\Catalog\Model\ImageUploader;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\RedirectFactory;
//use Magento\Framework\Exception\LocalizedException;
//use Magento\Framework\Serialize\Serializer\Json;

class Save extends Action
{
    private $redirectFactory;
    /**
     * @var StoreInterfaceFactory
     */
    private $storeFactory;
    /**
     * @var StoreRepositoryInterface
     */
    private $storeRepository;
    /**
     * @var ImageUploader
     */
    private $imageUploader;

    public function __construct(
        Context $context,
        RedirectFactory $redirectFactory,
        StoreInterfaceFactory $storeFactory,
        StoreRepositoryInterface $storeRepository,
        ImageUploader $imageUploader
    ) {
        parent::__construct($context);
        $this->storeFactory = $storeFactory;
        $this->storeRepository = $storeRepository;
        $this->imageUploader = $imageUploader;
        $this->redirectFactory = $redirectFactory;
    }

    public function execute()
    {
        $redirectResult = $this->redirectFactory->create();
        $store = $this->storeFactory->create();
        $data = $this->getRequest()->getPostValue();

        //$storeId = $data['store_id'];

        if (!$data['entity_id']) {
            $data['entity_id'] = null;
        } else {
            $store->setId($data['entity_id']);
        }

        $store->setName($data['name']);
        $store->setDescription($data['description']);
        $store->setAddress($data['address']);
        //$store->setUrl($data['url_key']);
        $store->setLatitude($data['latitude']);
        $store->setLongitude($data['longitude']);
        $store = $this->setImage($data, $store);
        $this->storeRepository->save($store);

        $redirectResult->setPath('*/*/index');
        return $redirectResult;
    }

    public function setImage($data, $store): StoreInterface
    {
        if (isset($data['image'][0]['name']) && isset($data['image'][0]['tmp_name'])) {
            $data['image'] = $data['image'][0]['name'];
            $this->imageUploader->moveFileFromTmp($data['image']);
        } elseif (isset($data['image'][0]['name']) && !isset($data['image'][0]['tmp_name'])) {
            $data['image'] = $data['image'][0]['name'];
        } else {
            $data['image'] = '';
        }
        $store->setImage($data['image']);
        return $store;
    }
}
