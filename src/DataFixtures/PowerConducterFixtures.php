<?php

namespace App\DataFixtures;

use App\Entity\PowerConducter;
use App\Enums\PowerConducterType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PowerConducterFixtures extends Fixture
{
    protected ObjectManager $manager;
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $this->createConducter(
            '01HT3HYPYP65S6AJP77DS26DEA',
            PowerConducterType::TWO_WIRE_SYS,
            '12 months'
        );
        $this->createConducter(
            '01HT3HZ0Y4BZ34GNGG7VFCCE2M',
            PowerConducterType::THREE_WIRE_SYS,
            '12 months'
        );
    }

    protected function createConducter(
        string $ulid,
        string $name,
        string $dateOffset
    ): void
    {
        $conducter = new PowerConducter();
        $conducter->setUlid($ulid);
        $conducter->setPowerConducter($name);
        $conducter->setUpdatedAt(new \DateTime($dateOffset));
        $conducter->setCreatedAt(new \DateTime($dateOffset));
        $this->manager->persist($conducter);
        $this->manager->flush();
    }
}