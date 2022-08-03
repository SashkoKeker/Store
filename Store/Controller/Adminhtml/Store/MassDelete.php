<?php

namespace Alexandr\Store\Controller\Adminhtml\Store;

use Alexandr\Store\Api\Data\StoreInterfaceFactory;
use Alexandr\Store\Model\ResourceModel\Store\CollectionFactory;
use Alexandr\Store\Api\StoreRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Backend\App\Action\Context;

class MassDelete extends Action
{
    private $filter;

    private $collectionFactory;

    private $storeRepository;

    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        StoreRepositoryInterface $storeRepository
    ) {
        parent::__construct($context);
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->storeRepository = $storeRepository;
    }

    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        foreach ($collection as $store){
            $this->storeRepository->delete($store);
        }
        $this->messageManager->addSuccessMessage(__('Record(s) have been deleted.'));
        $this->_redirect("*/*/index");
    }

}
