<?php

namespace Alexandr\Store\Api\Data;

interface StoreInterface
{
    const ID = 'entity_id';
    const NAME = 'name';
    const DESCRIPTION = 'description';
    const IMAGE = 'image';
    const ADDRESS = 'address';
    const SCHEDULE = 'schedule';
    const LONGITUDE = 'longitude';
    const LATITUDE = 'latitude';

    /**
     * @return string
     */
    public function getId();



    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string|null $name
     * @return void
     */
    public function setName(?string $name): void;

    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @param string|null $description
     * @return void
     */
    public function setDescription(?string $description): void;

    /**
     * @return string
     */
    public function getImage(): ?string;

    /**
     * @param string|null $image
     * @return void
     */
    public function setImage(?string $image): void;

    /**
     * @return string
     */
    public function getAddress(): string;

    /**
     * @param string|null $address
     * @return void
     */
    public function setAddress(?string $address): void;

    /**
     * @return string
     */
    public function getSchedule(): string;

    /**
     * @param string|null $schedule
     * @return void
     */
    public function setSchedule(?string $schedule): void;

    /**
     * @return string
     */
    public function getLongitude(): string;

    /**
     * @param string|null $longitude
     * @return void
     */
    public function setLongitude(?string $longitude): void;

    /**
     * @return string
     */
    public function getLatitude(): string;

    /**
     * @param string|null $latitude
     * @return void
     */
    public function setLatitude(?string $latitude): void;
}
