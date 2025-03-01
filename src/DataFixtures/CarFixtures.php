<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\OriginalCar;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CarFixtures extends Fixture
{
    private ObjectManager $manager;

    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;
        $this->createBrand(
            '01HT008NHYB79T1Z581BZJYVYD',
            'Porsche',
            '6 days'
        );
        $this->createBrand(
            '01HT0091V7HWGE2FQC5306QM83',
            'Audi',
            '6 days'
        );
        $this->createBrand(
            '01HT009948XEFMC60GY3C20T3X',
            'Dodge',
            '6 days'
        );
        $this->createBrand(
            '01HT009ME5TQJYAEMGM9C1A807',
            'Ford',
            '6 days'
        );
        $this->createBrand(
            '01HT00A32QC8FQ438S6MSTTX6N',
            'Mercedes Benz',
            '6 days'
        );
        $this->createBrand(
            '01HT00ABABBE6BNEXXXWTXDXBE',
            'Ferrari',
            '6 days'
        );


        $this->createCar(
            '911 gt3',
            '01HT008NHYB79T1Z581BZJYVYD',
            1000,
            736,
            1963,
            2024,
            'porsche-911-3341697_1280.jpg',
            '6 days',
        );
        $this->createCar(
            '488 Gtb',
            '01HT00ABABBE6BNEXXXWTXDXBE',
            950,
            699,
            2015,
            2024,
            'ferrari-488-4345304_1280.jpg',
            '12 days',
        );
        $this->createCar(
            'Testarossa',
            '01HT00ABABBE6BNEXXXWTXDXBE',
            860,
            632,
            1984,
            1996,
            'Ferrari-Testarossa.jpg',
            '6 days',
        );
        $this->createCar(
            'R8',
            '01HT0091V7HWGE2FQC5306QM83',
            755,
            555,
            1989,
            1995,
            'audi-r8-v10-plus-1555775_1280.jpg',
            '12 minutes',
        );
        $this->createCar(
            '911 gt3',
            '01HT008NHYB79T1Z581BZJYVYD',
            810,
            596,
            1963,
            2024,
            'porsche-911-3341697_1280.jpg',
            '6 days',
        );
        $this->createCar(
            '348',
            '01HT00ABABBE6BNEXXXWTXDXBE',
            825,
            607,
            1989,
            1995,
            'ferrari-348-2927398_1280.jpg',
            '12 minutes',
        );
    }

    protected function createBrand(
        string $ulid,
        string $brandName,
        string $dateOffset
    ): void
    {
        $brand = new Brand();
        $brand->setUlid($ulid);
        $brand->setBrandName($brandName);
        $brand->setUpdatedAt(new \DateTime($dateOffset));
        $brand->setCreatedAt(new \DateTime($dateOffset));

        $this->manager->persist($brand);
        $this->manager->flush();
    }

    protected function createCar(
        string $model,
        string $brand_ulid,
        int    $performancePS,
        int    $performanceKW,
        int $manufacturedFrom,
        int $manufacturedTo,
        string $image,
        string $dateOffset
    ): void
    {
        $car = new OriginalCar();
        $car->setModel($model);
        $car->setPerformancePS($performancePS);
        $car->setPerformanceKW($performanceKW);
        $car->setManufacturedFrom($manufacturedFrom);
        $car->setManufacturedTo($manufacturedTo);
        $car->setImage($image);
        $car->setUpdatedAt(new \DateTime($dateOffset));
        $car->setCreatedAt(new \DateTime($dateOffset));

        $brandRepo = $this->manager->getRepository(Brand::class);
        $brand = $brandRepo->findOneBy(['ulid' => $brand_ulid]);
        $car->setBrand($brand);

        $this->manager->persist($car);
        $this->manager->flush();
    }
}
