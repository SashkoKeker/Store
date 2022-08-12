<?php

declare(strict_types=1);

namespace Alexandr\Store\Block;

use Alexandr\Store\Api\StoreRepositoryInterface;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Element\Template;
use Magento\Framework\Serialize\Serializer\Json;

class Store extends Template
{
    private  $storeRepository;

    private $context;

    public function __construct(
        Context $context,
        StoreRepositoryInterface $storeRepository
//        Json $json
    ) {
        $this->storeRepository = $storeRepository;
        $this->context = $context;
//        $this->json = $json;
        parent::__construct($context);
    }

    public function getStore()
    {
        $store = $this->getRequest()->getParams();
        if (is_null($store)) {
            return null;
        }
        return $store['store'];
    }

//    /**
//     * @param $store
//     * @return string|void
//     */
//    public function unserializeSchedule($store)
//    {
//        try {
//            $schedule = $this->json->unserialize($store->getSchedule());
//            foreach ($schedule as & $temp) {
//                if (!isset($tmp)) {
//                    $tmp = "day \"" . $temp['day'] . "\" - from \"" . $temp['from'] . "\" to \"" . $temp['to'] . "\", <br/> ";
//                } else {
//                    $tmp = $tmp . "day \"" . $temp['day'] . "\" - from \"" . $temp['from'] . "\" to \"" . $temp['to'] . "\" <br/>";
//                }
//            }
//            return $tmp;
//        } catch (\Exception $exception) {
//
//        }
//    }
}
