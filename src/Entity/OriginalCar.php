<?php

namespace App\Entity;

use App\Repository\OriginalCarRepository;
use App\Service\IDService;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use MonterHealth\ApiFilterBundle\Attribute\ApiFilter;
use MonterHealth\ApiFilterBundle\Filter\DateFilter;
use MonterHealth\ApiFilterBundle\Filter\SearchFilter;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OriginalCarRepository::class)]
#[ORM\Table(name: "original_cars")]
class OriginalCar
{
    #[ORM\Id]
    #[ORM\Column(type: 'string')]
    protected string $ulid;

    #[ApiFilter(SearchFilter::class)]
    #[ORM\Column(length: 100)]
    protected string $model;

    #[ApiFilter(SearchFilter::class)]
    #[ORM\Column(type: 'smallint')]
    protected int $performancePS;

    #[ApiFilter(SearchFilter::class)]
    #[ORM\Column(type: 'smallint')]
    protected int $performanceKw;

    #[ApiFilter(DateFilter::class)]
    #[ORM\Column(type: 'datetimetz')]
    protected \DateTime $manufacturedFrom;

    #[ApiFilter(DateFilter::class)]
    #[ORM\Column(type: 'datetimetz')]
    protected \DateTime $manufacturedTo;

    #[ORM\Column(length: 255)]
    #[ApiFilter(SearchFilter::class)]
    protected string $image;

    #[ORM\Column]
    #[ApiFilter(DateFilter::class)]
    protected \DateTime $createdAt;

    #[ORM\Column]
    #[ApiFilter(DateFilter::class)]
    protected \DateTime $updatedAt;

    #[ORM\ManyToOne(targetEntity: Brand::class, inversedBy: 'cars')]
    #[ORM\JoinColumn(name: 'brand_ulid', referencedColumnName: 'ulid', onDelete: 'CASCADE')]
    protected Brand $brand;

    #[ORM\OneToMany(targetEntity: ModelCar::class, mappedBy: 'originalCar')]
    private Collection $modelCars;

    public function __construct()
    {
        $this->ulid ??= IDService::MakeULID(new \DateTime('now'));
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->modelCars = new ArrayCollection();
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

    public function getPerformancePS(): int
    {
        return $this->performancePS;
    }

    public function setPerformancePS(int $performancePS): void
    {
        $this->performancePS = $performancePS;
    }

    public function getPerformanceKw(): int
    {
        return $this->performanceKw;
    }

    public function setPerformanceKw(int $performanceKw): void
    {
        $this->performanceKw = $performanceKw;
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
     * @return Brand
     */
    public function getBrand(): Brand
    {
        return $this->brand;
    }

    /**
     * @param Brand $brand
     */
    public function setBrand(Brand $brand): self
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * @return Collection<int, ModelCar>
     */
    public function getModelCars(): Collection
    {
        return $this->modelCars;
    }

    public function addModelCar(ModelCar $modelCar): static
    {
        if (!$this->modelCars->contains($modelCar)) {
            $this->modelCars->add($modelCar);
            $modelCar->setOriginalCar($this);
        }

        return $this;
    }

    public function removeModelCar(ModelCar $modelCar): static
    {
        if ($this->modelCars->removeElement($modelCar)) {
            // set the owning side to null (unless already changed)
            if ($modelCar->getOriginalCar() === $this) {
                $modelCar->setOriginalCar(null);
            }
        }

        return $this;
    }

}
