<?php

namespace App\Repository;

use App\Entity\OriginalCar;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class OriginalCarRepository extends EntityRepository
{
    /**
     * @template-extends EntityRepository<OriginalCar>
     */
    public function __construct(EntityManagerInterface $registry)
    {
        parent::__construct($registry, $registry->getClassMetadata(OriginalCar::class));
    }

    public function findAllQueryBuilder(): QueryBuilder
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $qb->select(array('car'))
            ->from('App\Entity\OriginalCar', 'car');

        return $qb;
    }
    //    /**
    //     * @return OriginalCar[] Returns an array of OriginalCar objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('o.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?OriginalCar
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
