<?php

namespace App\Repository;

use App\Entity\Lighting;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Lighting>
 *
 * @method Lighting|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lighting|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lighting[]    findAll()
 * @method Lighting[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LightingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lighting::class);
    }

//    /**
//     * @return Lighting[] Returns an array of Lighting objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Lighting
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
