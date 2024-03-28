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

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    protected float $scale;

    #[ORM\Column(type: 'datetimetz')]
    protected \DateTime $manufacturedFrom;

    #[ORM\Column(type: 'datetimetz')]
    protected \DateTime $manufacturedTo;

    #[ORM\Column(type: 'datetimetz')]
    protected \DateTime $updatedAt;

    #[ORM\Column(type: 'datetimetz')]
    protected \DateTime $createdAt;

    #[ORM\ManyToOne(targetEntity: OriginalCar::class, inversedBy: 'modelCars')]
    #[ORM\JoinColumn(name: 'orginalcar_ulid', referencedColumnName: 'ulid', nullable: false)]
    protected ?OriginalCar $originalCar;

    #[ORM\ManyToOne(inversedBy: 'modelCars')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Manufacturer $manufacturer = null;

    #[ORM\ManyToOne]
    private ?PowerConducter $powerConducter = null;

    #[ORM\ManyToOne]
    private ?Lighting $lighting = null;

    #[ORM\ManyToOne]
    private ?Chassis $chassis = null;

    #[ORM\ManyToOne(inversedBy: 'modelCars')]
    private ?BodyDesign $bodyDesign = null;

    #[ORM\ManyToOne]
    private ?Remarks $remark = null;

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

    public function getManufacturer(): ?Manufacturer
    {
        return $this->manufacturer;
    }

    public function setManufacturer(?Manufacturer $manufacturer): static
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function getPowerConducter(): ?PowerConducter
    {
        return $this->powerConducter;
    }

    public function setPowerConducter(?PowerConducter $powerConducter): static
    {
        $this->powerConducter = $powerConducter;

        return $this;
    }

    public function getLighting(): ?Lighting
    {
        return $this->lighting;
    }

    public function setLighting(?Lighting $lighting): static
    {
        $this->lighting = $lighting;

        return $this;
    }

    public function getChassis(): ?Chassis
    {
        return $this->chassis;
    }

    public function setChassis(?Chassis $chassis): static
    {
        $this->chassis = $chassis;

        return $this;
    }

    public function getBodyDesign(): ?BodyDesign
    {
        return $this->bodyDesign;
    }

    public function setBodyDesign(?BodyDesign $bodyDesign): static
    {
        $this->bodyDesign = $bodyDesign;

        return $this;
    }

    public function getRemark(): ?Remarks
    {
        return $this->remark;
    }

    public function setRemark(?Remarks $remark): static
    {
        $this->remark = $remark;

        return $this;
    }
}
