<?php

namespace App\Repository;

use App\Entity\TypeOuvrage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeOuvrage>
 *
 * @method TypeOuvrage|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeOuvrage|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeOuvrage[]    findAll()
 * @method TypeOuvrage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeOuvrageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeOuvrage::class);
    }

    //    /**
    //     * @return TypeOuvrage[] Returns an array of TypeOuvrage objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?TypeOuvrage
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
