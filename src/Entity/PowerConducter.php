<?php

namespace App\Entity;

use App\Repository\PowerConducterRepository;
use App\Service\IDService;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PowerConducterRepository::class)]
class PowerConducter
{
    #[ORM\Id]
    #[ORM\Column]
    protected string $ulid;

    #[ORM\Column(type: 'string')]
    protected string $powerConducter;

    #[ORM\Column(type: 'datetimetz')]
    protected \DateTime $createdAt;

    #[ORM\Column(type: 'datetimetz')]
    protected \DateTime $updatedAt;
    public function __construct()
    {
        $this->ulid ??= IDService::MakeULID(new \DateTime('now'));
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * @param string $ulid
     */
    public function setUlid(string $ulid): void
    {
        $this->ulid = $ulid;
    }
    public function getUlid(): string
    {
        return $this->ulid;
    }

    public function getPowerConducter(): string
    {
        return $this->powerConducter;
    }

    public function setPowerConducter(string $powerConducter): void
    {
        $this->powerConducter = $powerConducter;
    }


    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
