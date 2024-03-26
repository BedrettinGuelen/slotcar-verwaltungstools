<?php

namespace App\DataFixtures;

use App\Entity\OriginalCar;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CarFixtures extends Fixture implements OrderedFixtureInterface
{
    private ObjectManager $manager;

    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;


    }
    protected function createAction(
        string $model,
        string $performance,
        string $manufacturedFrom,
        string $manufacturedTo,
        int $image,
        string $referenceName,
        string $dateOffset
    ):void
    {
        $car = new OriginalCar();
        $car->setModel($model);
        $car->setPerformance($performance);
        $car->setManufacturedFrom(new \DateTime($manufacturedFrom));
        $car->setManufacturedTo(new \DateTime($manufacturedTo));
        $car->setImage($image);
        $car->setUpdatedAt(new \DateTime($dateOffset));
        $car->setCreatedAt(new \DateTime($dateOffset));

        $this->manager->persist($car);
        $this->manager->flush();

        $this->addReference($referenceName);

    }

    public function getOrder() {
        return 0;
    }
}
