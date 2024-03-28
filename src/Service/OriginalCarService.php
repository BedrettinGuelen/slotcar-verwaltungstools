<?php

namespace App\Service;

use App\Entity\OriginalCar;
use App\Repository\OriginalCarRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\ParameterBag;

class OriginalCarService
{
    public function __construct(
        protected ManagerRegistry $registry,
        protected OriginalCarRepository $originalCarRepository
    )
    {
    }

    public function getFilteredCars(
        string $brand,
        string $model,
        int $page,
        int $limit
    ): array
    {
        $qb = $this->originalCarRepository->findAllQueryBuilder();
        $query = new ParameterBag([
            'page' => $page,
            'limit' => $limit
        ]);

        if (!isset($brand)){
            $query->add(['brand[in]' => $brand]);
            dd($query);
        }
        if (!isset($model)){
            $query->add(['model[in]' => $model]);
        }
        return [''];
    }
}