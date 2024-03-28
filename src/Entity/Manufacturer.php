<?php

namespace App\Entity;

use App\Repository\ManufacturerRepository;
use App\Service\IDService;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ManufacturerRepository::class)]
class Manufacturer
{
    #[ORM\Id]
    #[ORM\Column]
    protected string $ulid;

    #[ORM\Column(type: 'string')]
    protected string $manufacturer;

    #[ORM\Column(type: 'datetimetz')]
    protected \DateTime $createdAt;

    #[ORM\Column(type: 'datetimetz')]
    protected \DateTime $updatedAt;

    #[ORM\OneToMany(targetEntity: ModelCar::class, mappedBy: 'manufacturer', orphanRemoval: true)]
    private Collection $modelCars;

    public function __construct()
    {
        $this->ulid ??= IDService::MakeULID(new \DateTime('now'));
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->modelCars = new ArrayCollection();
    }

    public function setUlid(string $ulid): static
    {
        $this->ulid = $ulid;
        return $this;
    }

    public function getUlid(): string
    {
        return $this->ulid;
    }

    public function getManufacturer(): string
    {
        return $this->manufacturer;
    }

    public function setManufacturer(string $manufacturer): void
    {
        $this->manufacturer = $manufacturer;
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
            $modelCar->setManufacturer($this);
        }

        return $this;
    }

    public function removeModelCar(ModelCar $modelCar): static
    {
        if ($this->modelCars->removeElement($modelCar)) {
            // set the owning side to null (unless already changed)
            if ($modelCar->getManufacturer() === $this) {
                $modelCar->setManufacturer(null);
            }
        }

        return $this;
    }
}
