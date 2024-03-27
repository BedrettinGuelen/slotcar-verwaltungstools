<?php

namespace App\Repository;

use App\Entity\Chassis;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Chassis>
 *
 * @method Chassis|null find($id, $lockMode = null, $lockVersion = null)
 * @method Chassis|null findOneBy(array $criteria, array $orderBy = null)
 * @method Chassis[]    findAll()
 * @method Chassis[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChasisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Chassis::class);
    }

//    /**
//     * @return Chasis[] Returns an array of Chasis objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Chasis
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
