<?php

declare(strict_types=1);

namespace Alexandr\Store\Model;

use Alexandr\Store\Api\Data\StoreInterface;
use Alexandr\Store\Model\ResourceModel\Store as ResourceModel;
use Magento\Framework\Model\AbstractModel;

class Store extends AbstractModel implements StoreInterface
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * @return int|string
     */
    public function getId()
    {
        return $this->getData(StoreInterface::ID);
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->getData(StoreInterface::NAME);
    }

    /**
     * @param string|null $name
     * @return StoreInterface
     */
    public function setName(?string $name): StoreInterface
    {
        $this->setData(StoreInterface::NAME, $name);
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->getData(StoreInterface::DESCRIPTION);
    }

    /**
     * @param string|null $description
     * @return StoreInterface
     */
    public function setDescription(?string $description): StoreInterface
    {
        $this->setData(StoreInterface::DESCRIPTION, $description);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->getData(StoreInterface::IMAGE);
    }

    /**
     * @param string|null $image
     * @return StoreInterface
     */
    public function setImage($image): StoreInterface
    {
        $this->setData(self::IMAGE, $image);
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->getData(StoreInterface::ADDRESS);
    }

    /**
     * @param string|null $address
     * @return StoreInterface
     */
    public function setAddress(?string $address): StoreInterface
    {
        $this->setData(StoreInterface::ADDRESS, $address);
        return $this;
    }

    public function getSchedule(): string
    {
        return $this->getData(StoreInterface::SCHEDULE);
    }

    public function setSchedule(?string $schedule): StoreInterface
    {
        $this->setData(StoreInterface::SCHEDULE, $schedule);
        return $this;
    }

    public function getLongitude(): string
    {
        return $this->getData(StoreInterface::LONGITUDE);
    }

    public function setLongitude(?string $longitude): StoreInterface
    {
        $this->setData(StoreInterface::LONGITUDE, $longitude);
        return $this;
    }

    public function getLatitude(): string
    {
        return $this->getData(StoreInterface::LATITUDE);
    }

    public function setLatitude(?string $latitude): StoreInterface
    {
        $this->setData(StoreInterface::LATITUDE, $latitude);
        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->getData(self::STORE_URL_KEY);
    }

    public function setUrl(string $store_url_key): StoreInterface
    {
        $this->setData(self::STORE_URL_KEY, $store_url_key);
        return $this;
    }

    /**
     * @param string $store_url_key
     * @return StoreInterface
     */
    public function checkUrlKey(string $store_url_key): StoreInterface
    {
        $this->_init(ResourceModel::class);
        return $this->_resource->checkUrlKey($store_url_key, );
    }
}
