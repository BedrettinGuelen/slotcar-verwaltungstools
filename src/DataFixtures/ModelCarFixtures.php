<?php

namespace App\DataFixtures;

use App\Entity\Manufacturer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ModelCarFixtures extends Fixture
{
    private ObjectManager $manager;
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;


    }


    protected function createPowerConducter(): void
    {

    }
    protected function createLighting(): void
    {

    }
    protected function createChassis(): void
    {

    }
    protected function createBodyDesign(): void
    {

    }
    protected function createRemark(): void
    {

    }
}