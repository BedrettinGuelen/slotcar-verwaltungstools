<?php

namespace App\Entity;

use App\Repository\OriginalCarRepository;
use App\Service\IDService;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OriginalCarRepository::class)]
class OriginalCar
{
    #[ORM\Id]
    #[ORM\Column(type: 'string')]
    private string $ulid;


    #[ORM\Column(length: 100)]
    private string $model;

    #[ORM\Column]
    private int $performance;

    #[ORM\Column]
    private \DateTime $manufacturedFrom;

    #[ORM\Column]
    private \DateTime $manufacturedTo;

    #[ORM\Column(length: 255)]
    private string $image;

    #[ORM\Column]
    private \DateTime $createdAt;
    #[ORM\Column]
    private \DateTime $updatedAt;


    public function __construct()
    {
        $this->ulid ??= IDService::MakeULID(new \DateTime('now'));
        $this->createdAt = new \DateTime('now');
        $this->updatedAt = new \DateTime('now');
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

    public function getPerformance(): ?int
    {
        return $this->performance;
    }

    public function setPerformance(int $performance): static
    {
        $this->performance = $performance;

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

}
