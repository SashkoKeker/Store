<?php

namespace Alexandr\Store\Setup;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Model\Product;
use Magento\Framework\App\ProductMetadataInterface;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Model\Config;

class InstallData implements InstallDataInterface
{

    const CUSTOM_ATTRIBUTE_CODE = 'in_stock';
    /**
     * @var EavSetup
     */
    private EavSetup $eavSetup;

    /**
     * @var Config
     */
    private Config $eavConfig;

    /**
     * @param EavSetup $eavSetup
     * @param Config $config
     */
    public function __construct(
        EavSetup $eavSetup,
        Config $config
    )
    {
        $this->eavSetup = $eavSetup;
        $this->eavConfig = $config;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Zend_Validate_Exception
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $this->eavSetup->addAttribute(
          Product::ENTITY,
            self::CUSTOM_ATTRIBUTE_CODE,
            [
                'label' => 'In_stock',
                'input' => 'text',
                'visible' => true,
                'required' => false,
                'position' => 150,
                'sort_order' => 150,
                'system' => false
            ]
        );

        $customAttribute = $this->eavConfig->getAttribute(
            Product::ENTITY,
            self::CUSTOM_ATTRIBUTE_CODE
        );

        $customAttribute->setData(
            'used_in_forms',
            ['catalog_product_edit']
        );

        $customAttribute->save();

        $setup->endSetup();
    }
}
