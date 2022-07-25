<?php

namespace Alexandr\Store\Model;

use Alexandr\Store\Api\Data\StoreInterface;
use Magento\Framework\Model\AbstractModel;

class Store extends AbstractModel implements StoreInterface
{
    protected function _construct()
    {
        $this->_init('Alexandr\Store\Model\ResourceModel\Store');
    }

    public function getId(): string
    {
        return $this->getData(StoreInterface::ID);
    }


    public function getName(): string
    {
        return $this->getData(StoreInterface::NAME);
    }

    public function setName(?string $name): void
    {
        $this->setData(StoreInterface::NAME, $name);
    }

    public function getDescription(): string
    {
        return $this->getData(StoreInterface::DESCRIPTION);
    }

    public function setDescription(?string $description): void
    {
        $this->setData(StoreInterface::NAME, $description);
    }

    public function getImage(): string
    {
        return $this->getData(StoreInterface::IMAGE);
    }

    public function setImage(?string $image): void
    {
        $this->setData(StoreInterface::NAME, $image);
    }

    public function getAddress(): string
    {
        return $this->getData(StoreInterface::ADDRESS);
    }

    public function setAddress(?string $address): void
    {
        $this->setData(StoreInterface::NAME, $address);
    }

    public function getSchedule(): string
    {
        return $this->getData(StoreInterface::SCHEDULE);
    }

    public function setSchedule(?string $schedule): void
    {
        $this->setData(StoreInterface::NAME, $schedule);
    }

    public function getLongitude(): string
    {
        return $this->getData(StoreInterface::LONGITUDE);
    }

    public function setLongitude(?string $longitude): void
    {
        $this->setData(StoreInterface::NAME, $longitude);
    }

    public function getLatitude(): string
    {
        return $this->getData(StoreInterface::LATITUDE);
    }

    public function setLatitude(?string $latitude): void
    {
        $this->setData(StoreInterface::NAME, $latitude);
    }
}
