<?php

namespace App\Repository;

use App\Entity\EditeurVf;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EditeurVf>
 *
 * @method EditeurVf|null find($id, $lockMode = null, $lockVersion = null)
 * @method EditeurVf|null findOneBy(array $criteria, array $orderBy = null)
 * @method EditeurVf[]    findAll()
 * @method EditeurVf[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EditeurVfRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EditeurVf::class);
    }

    //    /**
    //     * @return EditeurVf[] Returns an array of EditeurVf objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?EditeurVf
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
