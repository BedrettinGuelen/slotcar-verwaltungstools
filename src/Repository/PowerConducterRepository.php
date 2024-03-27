<?php

namespace App\Repository;

use App\Entity\PowerConducter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PowerConducter>
 *
 * @method PowerConducter|null find($id, $lockMode = null, $lockVersion = null)
 * @method PowerConducter|null findOneBy(array $criteria, array $orderBy = null)
 * @method PowerConducter[]    findAll()
 * @method PowerConducter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PowerConducterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PowerConducter::class);
    }

//    /**
//     * @return PowerConducter[] Returns an array of PowerConducter objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PowerConducter
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
