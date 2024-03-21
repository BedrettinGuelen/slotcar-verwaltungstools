<?php

namespace App\Entity;

use App\Repository\OriginalCarRepository;
use Doctrine\ORM\Mapping as ORM;
Use Ulid\Ulid;

#[ORM\Entity(repositoryClass: OriginalCarRepository::class)]
class OriginalCar
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $brand = null;

    #[ORM\Column(length: 100)]
    private ?string $model = null;

    #[ORM\Column]
    private ?int $performance = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $manufacturedFrom = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $manufacturedTo = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): static
    {
        $this->brand = $brand;

        return $this;
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

    public function getManufacturedFrom(): ?\DateTimeImmutable
    {
        return $this->manufacturedFrom;
    }

    public function setManufacturedFrom(\DateTimeImmutable $manufacturedFrom): static
    {
        $this->manufacturedFrom = $manufacturedFrom;

        return $this;
    }

    public function getManufacturedTo(): ?\DateTimeImmutable
    {
        return $this->manufacturedTo;
    }

    public function setManufacturedTo(\DateTimeImmutable $manufacturedTo): static
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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
