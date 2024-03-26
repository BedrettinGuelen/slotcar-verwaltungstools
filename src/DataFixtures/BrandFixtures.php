<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BrandFixtures extends Fixture
{
    private ObjectManager $manager;
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $this->createAction(
            'BMW',
            '6 days'
        );
        $this->createAction(
            'Corvette',
            '6 days'
        );
        $this->createAction(
            'Audi',
            '6 days'
        );
        $this->createAction(
            'Dodge',
            '6 days'
        );
        $this->createAction(
            'Chrysler',
            '6 days'
        );
        $this->createAction(
            'VW',
            '6 days'
        );
        $this->createAction(
            'Ford',
            '6 days'
        );
        $this->createAction(
            'McLaren',
            '6 Minutes'
        );
        $this->createAction(
            'Aston Martin',
            '6 days'
        );
        $this->createAction(
            'Mercedes',
            '6 days'
        );
        $this->createAction(
            'Ferrari',
            '6 days'
        );
    }
    protected function createAction(
        string $brandName,
        string $carReference,
        string $dateOffset = 'now'
    ):void
    {
        $brand = new Brand();
        $brand->setBrandName($brandName);
        $brand->setUpdatedAt(new \DateTime($dateOffset));
        $brand->setCreatedAt(new \DateTime($dateOffset));

        $brand->set

        $this->manager->persist($brand);
        $this->manager->flush();
    }

    public function getOrder() {
        return 1;
    }
}