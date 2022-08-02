<?php

namespace Alexandr\Store\UI\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;

class Thumbnail extends \Magento\Catalog\Ui\Component\Listing\Columns\Thumbnail
{
    const  ALT_FIELD = 'title';

    protected $storeManager;

    protected $urlBuilder;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        \Magento\Catalog\Helper\Image $imageHelper,
        \Magento\Framework\UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    )
    {
        parent::__construct($context, $uiComponentFactory, $imageHelper, $urlBuilder, $components, $data);
    }

}
