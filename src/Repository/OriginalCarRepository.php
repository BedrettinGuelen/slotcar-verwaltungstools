<?php

namespace App\Repository;

use App\Entity\OriginalCar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OriginalCar>
 *
 * @method OriginalCar|null find($id, $lockMode = null, $lockVersion = null)
 * @method OriginalCar|null findOneBy(array $criteria, array $orderBy = null)
 * @method OriginalCar[]    findAll()
 * @method OriginalCar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OriginalCarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OriginalCar::class);
    }

    public function findSearchedCar(?string $search = null, ?int $manufacturedyear = null): array
    {
        $qb = $this->createQueryBuilder('car')
            ->orderBy('car.createdAt', 'DESC')
            ->innerJoin('car.brand', 'brand')
            ->addSelect('brand');

        if ($search){
            $qb
                ->andWhere('car.model Like :searchTerm')
                ->orWhere('brand.brandName Like :searchTerm')
                ->setParameter('searchTerm', '%'.$search.'%');
        }

        if($manufacturedyear){
            $qb
                ->andWhere('car.manufacturedFrom <= :manufacturedYear')
                ->andWhere('car.manufacturedTo >= :manufacturedYear')
                ->setParameter('manufacturedYear', $manufacturedyear);
        }

       
        return $qb->setMaxResults(10)->getQuery()->getResult();
    }
}
