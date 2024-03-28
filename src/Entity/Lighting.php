<?php

namespace App\Entity;

use App\Repository\LightingRepository;
use App\Service\IDService;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LightingRepository::class)]
class Lighting
{
    #[ORM\Id]
    #[ORM\Column]
    protected string $ulid;

    #[ORM\Column(type: 'string')]
    protected string $lighting;

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

    public function getLighting(): string
    {
        return $this->lighting;
    }

    public function setLighting(string $lighting): void
    {
        $this->lighting = $lighting;
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
