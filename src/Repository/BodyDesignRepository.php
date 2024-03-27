<?php

namespace App\Repository;

use App\Entity\BodyDesign;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BodyDesign>
 *
 * @method BodyDesign|null find($id, $lockMode = null, $lockVersion = null)
 * @method BodyDesign|null findOneBy(array $criteria, array $orderBy = null)
 * @method BodyDesign[]    findAll()
 * @method BodyDesign[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BodyDesignRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BodyDesign::class);
    }

//    /**
//     * @return BodyDesign[] Returns an array of BodyDesign objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?BodyDesign
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
