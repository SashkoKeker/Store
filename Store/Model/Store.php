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

    public function getId()
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
        $this->setData(StoreInterface::DESCRIPTION, $description);
    }

    public function getImage(): string
    {
        return $this->getData(StoreInterface::IMAGE);
    }

    public function setImage(?string $image): void
    {
        $this->setData(StoreInterface::IMAGE, $image);
    }

    public function getAddress(): string
    {
        return $this->getData(StoreInterface::ADDRESS);
    }

    public function setAddress(?string $address): void
    {
        $this->setData(StoreInterface::ADDRESS, $address);
    }

    public function getSchedule(): string
    {
        return $this->getData(StoreInterface::SCHEDULE);
    }

    public function setSchedule(?string $schedule): void
    {
        $this->setData(StoreInterface::SCHEDULE, $schedule);
    }

    public function getLongitude(): string
    {
        return $this->getData(StoreInterface::LONGITUDE);
    }

    public function setLongitude(?string $longitude): void
    {
        $this->setData(StoreInterface::LONGITUDE, $longitude);
    }

    public function getLatitude(): string
    {
        return $this->getData(StoreInterface::LATITUDE);
    }

    public function setLatitude(?string $latitude): void
    {
        $this->setData(StoreInterface::LATITUDE, $latitude);
    }
}
