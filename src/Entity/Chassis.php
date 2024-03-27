<?php

namespace App\Entity;

use App\Repository\ChasisRepository;
use App\Service\IDService;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChasisRepository::class)]
class Chassis
{
    #[ORM\Id]
    #[ORM\Column]
    protected string $ulid;

    #[ORM\Column(type: 'string')]
    protected string $chassis;

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
    public function getUlid(): string
    {
        return $this->ulid;
    }

    public function getChassis(): string
    {
        return $this->chassis;
    }

    public function setChassis(string $chassis): void
    {
        $this->chassis = $chassis;
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
