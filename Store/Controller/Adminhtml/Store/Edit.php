<?php

namespace Alexandr\Store\Controller\Adminhtml\Store;



use Alexandr\Store\Api\Data\StoreInterfaceFactory;
use Alexandr\Store\Api\StoreRepositoryInterface;
use Alexandr\Store\Model\StoreRepository;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Store\Model\StoreManagerInterface;

class Edit extends Action
{
    const ADMIN_RESOURCE = "Alexandr::Store";
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var StoreInterfaceFactory
     */
    protected $storeFactory;
    /**
     * @var StoreRepositoryInterface
     */
    protected $storeRepository;
    /**
     * @var
     */
    protected $dataProvider;
    /**
     * @var
     */
    protected $coreRegistry;
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    public function __construct(
        Context $context,
        StoreInterfaceFactory $storeInterfaceFactory,
        StoreRepositoryInterface $storeRepository,
        StoreManagerInterface $storeManager,
        PageFactory $resultPageFactory
    )
    {

        parent::__construct($context);
        $this->storeRepository = $storeRepository;
        $this->storeFactory = $storeInterfaceFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->storeManager = $storeManager;
    }

    public function execute()
    {
        $storeViewId = $this->getRequest()->getParam('store', 0);
        $storeView = $this->storeManager->getStore($storeViewId);
        $this->storeManager->setCurrentStore($storeView->getCode());

        $id = $this->getRequest()->getParam('entity_id');
        if ($id) {
            $store = $this->storeRepository->get($id, $storeViewId);
            if (!$store->getId()) {
                //$this->messageManager->addErrorMessage(__('No store with that id'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
//        try {
//
//            $store = $this->storeRepository->get($id);
//
//            $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
//            $result->setActiveMenu('Alexandr_Store::menu_1')
//                ->addBreadcrumb(__('Edit Store'), __('Store'));
//            $result->getConfig()
//                ->getTitle()
//                ->prepend(__('Edit Store: %store', ['store' => $store->getId()]));
//
//        } catch (NoSuchEntityException $e) {
//            $result = $this->resultRedirectFactory->create();
//            $this->messageManager->addErrorMessage(
//                __('Store with id "%value" does not exist.', ['value' => $id])
//            );
//            $result->setPath('*/*');
//
//        }
//        return $result;

        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Alexandr_Store::menu_1');
        $resultPage->getConfig()->getTitle()->prepend(__('Store'));
        $resultPage->addHandle('store_store_entity' . $id);
        return $resultPage;
    }
}



