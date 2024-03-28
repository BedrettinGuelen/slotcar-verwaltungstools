<?php

namespace App\DataFixtures;

use App\Entity\Lighting;
use App\Enums\LightingTypes;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LightingFixtures extends Fixture
{
    private ObjectManager $manager;
    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;
        $this->createLighting(
            '01HT3JEBVNBDDCE08W377G811B',
            LightingTypes::NO_LIGHT,
            '6 seconds'
        );
        $this->createLighting(
            '01HT3JF1AVGZBJM0A8HQ4BN1SK',
            LightingTypes::LIGHT_SWITCH,
            '6 seconds'
        );
        $this->createLighting(
            '01HT3JFGSD6C5F2TVT4HJJDSRK',
            LightingTypes::CONTINUOUS_LIGHT,
            '6 days'
        );
        $this->createLighting(
            '01HT3JG4QCBC2BMEGH0PTY3HCR',
            LightingTypes::ONLY_BACKLIGHTING,
            '6 seconds'
        );
        $this->createLighting(
            '01HT3JGR6BE53C9G4RD76FN0JK',
            LightingTypes::ONLY_HEADLIGHTS,
            '6 seconds'
        );
    }

    protected function createLighting(
        string $ulid,
        string $name,
        string $dateOffset
    ):void
    {
        $lighting = new Lighting();
        $lighting->setUlid($ulid);
        $lighting->setLighting($name);
        $lighting->setUpdatedAt(new \DateTime($dateOffset));
        $lighting->setCreatedAt(new \DateTime($dateOffset));
        $this->manager->persist($lighting);
        $this->manager->flush();
    }
}