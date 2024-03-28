<?php
declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Manufacturer;
use App\Enums\Manufacturers;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ManufacturerFixture extends Fixture
{
    private ObjectManager $manager;
    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;
        $this->createManufacturer(
            '01HT3G75J86T4X28HBHBD3PZK9',
            Manufacturers::CARRERA,
            '6 seconds'
        );
        $this->createManufacturer(
            '01HT3G8RX5J3CVQC23K2MN7C4S',
            Manufacturers::FLY_CAR_MODEL,
            '6 minutes'
        );
        $this->createManufacturer(
            '01HT3G9AXQT5064PJTH9MN751K',
            Manufacturers::SCALEXTRIC,
            '6 days'
        );
        $this->createManufacturer(
            '01HT3G9FNB4C4BNEZQGK0FDK0E',
            Manufacturers::SIDEWAYS,
            '6 months'
        );
        $this->createManufacturer(
            '01HT3G9KX16R7E6CRXP2X20B2W',
            Manufacturers::SIDEWAYS,
            '6 years'
        );
    }

    protected function createManufacturer(
        string $ulid,
        string $name,
        string $dateOffset
    ):void
    {
        $manufacturer = new Manufacturer();
        $manufacturer->setUlid($ulid);
        $manufacturer->setManufacturer($name);
        $manufacturer->setUpdatedAt(new \DateTime($dateOffset));
        $manufacturer->setCreatedAt(new \DateTime($dateOffset));
        $this->manager->persist($manufacturer);
        $this->manager->flush();
    }
}