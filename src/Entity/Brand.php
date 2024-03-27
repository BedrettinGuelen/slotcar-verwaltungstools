<?php

namespace App\Entity;

use App\Repository\BrandRepository;
use App\Service\IDService;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BrandRepository::class)]
class Brand
{
    #[ORM\Id]
    #[ORM\Column(type: 'string')]
    protected string $ulid;

    #[ORM\Column(type: 'string')]
    protected string $brandName;

    #[ORM\Column(type: 'datetimetz')]
    protected \DateTime $createdAt;

    #[ORM\Column(type: 'datetimetz')]
    protected \DateTime $updatedAt;
    #[ORM\OneToMany(targetEntity: OriginalCar::class, mappedBy: 'brand')]
    protected Collection $cars;

    public function __construct()
    {
        $this->ulid ??= IDService::MakeULID(new \DateTime('now'));
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->cars = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getUlid(): string
    {
        return $this->ulid;
    }

    /**
     * @param string $ulid
     */
    public function setUlid(string $ulid): void
    {
        $this->ulid = $ulid;
    }

    /**
     * @return string
     */
    public function getBrandName(): string
    {
        return $this->brandName;
    }

    /**
     * @param string $brandName
     */
    public function setBrandName(string $brandName): self
    {
        $this->brandName = $brandName;
        return $this;
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

    public function getCars(): Collection
    {
        return $this->cars;
    }

    public function addCars(OriginalCar $cars): static
    {
        if (!$this->cars->contains($cars)) {
            $this->cars->add($cars);
            $cars->setBrand($this);
        }
        return $this;
    }

    public function removeCars(OriginalCar $cars): static
    {
        if ($this->cars->removeElement($cars)) {
            // set the owning side to null (unless already changed)
            if ($cars->getModel() === $this) {
                $cars->setModel(null);
            }
        }
        return $this;
    }

}