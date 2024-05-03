<?php

namespace App\Entity;

use App\Repository\OriginalCarRepository;
use App\Service\IDService;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OriginalCarRepository::class)]
class OriginalCar
{
    #[ORM\Id]
    #[ORM\Column(type: 'string')]
    protected string $ulid;

    #[ORM\Column(length: 100)]
    protected string $model;

    #[ORM\Column]
    protected int $performancePS;

    #[ORM\Column]
    protected int $performanceKW;

    #[ORM\Column(type: "datetime")]
    protected ?\DateTime $manufacturedFrom;
    
    #[ORM\Column(type: "datetime")]
    protected ?\DateTime $manufacturedTo;

    #[ORM\Column(length: 255)]
    protected string $image;

    #[ORM\Column]
    protected \DateTime $createdAt;
    #[ORM\Column]
    protected \DateTime $updatedAt;

    #[ORM\ManyToOne(targetEntity: Brand::class, inversedBy: 'cars')]
    #[ORM\JoinColumn(name: 'brand_ulid', referencedColumnName: 'ulid', onDelete: 'CASCADE')]
    protected ?Brand $brand;

    public function __construct()
    {
        $this->ulid ??= IDService::MakeULID(new \DateTime('now'));
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }


    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getPerformancePS(): ?int
    {
        return $this->performancePS;
    }

    public function setPerformancePS(int $performancePS): static
    {
        $this->performancePS = $performancePS;

        return $this;
    }

    /**
     * @return int
     */
    public function getPerformanceKW(): int
    {
        return $this->performanceKW;
    }

    /**
     * @param int $performanceKW
     */
    public function setPerformanceKW(int $performanceKW): static
    {
        $this->performanceKW = $performanceKW;
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUlid(): string
    {
        return $this->ulid;
    }


    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return Brand|null
     */
    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    /**
     * @param Brand|null $brand
     */
    public function setBrand(?Brand $brand): self
    {
        $this->brand = $brand;
        return $this;
    }

}
