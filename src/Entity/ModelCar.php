<?php

namespace App\Entity;

use App\Repository\ModelCarRepository;
use App\Service\IDService;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModelCarRepository::class)]
class ModelCar
{
    #[ORM\Id]
    #[ORM\Column(type: 'string')]
    protected string $ulid;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale:2)]
    protected float $scale;

    #[ORM\Column(type: 'datetimetz')]
    protected \DateTime $manufacturedFrom;

    #[ORM\Column(type: 'datetimetz')]
    protected \DateTime $manufacturedTo;

    #[ORM\Column(type: 'datetimetz')]
    protected \DateTime $updatedAt;

    #[ORM\Column(type: 'datetimetz')]
    protected \DateTime $createdAt;

    #[ORM\ManyToOne(inversedBy: 'modelCars')]
    #[ORM\JoinColumn(nullable: false)]
    protected ?OriginalCar $originalCar;

    public function __construct()
    {
        $this->ulid ??= IDService::MakeULID(new \DateTime('now'));
        $this->setUpdatedAt(new \DateTime('now'));
        $this->setCreatedAt(new \DateTime('now'));
    }

    public function getUlid(): string
    {
        return $this->ulid;
    }

    public function getScale(): ?string
    {
        return $this->scale;
    }

    public function setScale(string $scale): static
    {
        $this->scale = $scale;

        return $this;
    }

    public function getManufacturedFrom(): ?\DateTime
    {
        return $this->manufacturedFrom;
    }

    public function setManufacturedFrom(\DateTime $manufacturedFrom): static
    {
        $this->manufacturedFrom = $manufacturedFrom;

        return $this;
    }

    public function getManufacturedTo(): ?\DateTime
    {
        return $this->manufacturedTo;
    }

    public function setManufacturedTo(\DateTime $manufacturedTo): static
    {
        $this->manufacturedTo = $manufacturedTo;

        return $this;
    }

    public function getOriginalCar(): ?OriginalCar
    {
        return $this->originalCar;
    }

    public function setOriginalCar(?OriginalCar $originalCar): static
    {
        $this->originalCar = $originalCar;

        return $this;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
