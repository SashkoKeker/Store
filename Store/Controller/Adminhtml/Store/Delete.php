<?php

namespace Alexandr\Store\Controller\Adminhtml\Store;


use Alexandr\Store\Api\Data\StoreInterfaceFactory;
use Alexandr\Store\Api\StoreRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\RedirectFactory;

class Delete extends Action
{
    protected $resultFactory;

    protected $resultRedirectFactory;

    protected $storeFactory;

    protected $storeRepository;

    public function __construct(
        Context $context,
        StoreInterfaceFactory $storeFactory,
        StoreRepositoryInterface $storeRepository,
        RedirectFactory $resultRedirectFactory
    ) {
        $this->resultFactory = $resultRedirectFactory;
        $this->storeRepository = $storeRepository;
        $this->storeFactory = $storeFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('entity_id');
        $store = $this->storeRepository->get($id);
        $this->storeRepository->delete($store);
        $result = $this->resultRedirectFactory->create();
        $result->setpath('store/store/index');
    }
}
