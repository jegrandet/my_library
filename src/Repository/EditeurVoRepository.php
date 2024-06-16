<?php

namespace App\Repository;

use App\Entity\EditeurVo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EditeurVo>
 *
 * @method EditeurVo|null find($id, $lockMode = null, $lockVersion = null)
 * @method EditeurVo|null findOneBy(array $criteria, array $orderBy = null)
 * @method EditeurVo[]    findAll()
 * @method EditeurVo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EditeurVoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EditeurVo::class);
    }

    //    /**
    //     * @return EditeurVo[] Returns an array of EditeurVo objects
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

    //    public function findOneBySomeField($value): ?EditeurVo
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
