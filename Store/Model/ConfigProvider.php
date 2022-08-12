<?php

namespace Alexandr\Store\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class ConfigProvider
{
    //const XML_PATH_ENABLE = 'elogic/storelocator/enable';
    const XML_PATH_GOOGLE_API_KEY = 'store/store/google_api_key';

    private $scopeConfig;

    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    public function getGoogleMapsApiKey(): string
    {
        return (string) $this->scopeConfig->getValue(
            self::XML_PATH_GOOGLE_API_KEY,
            ScopeInterface::SCOPE_STORE
        );
    }
}
