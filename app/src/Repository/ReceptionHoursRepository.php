<?php

namespace App\Repository;

use App\Entity\ReceptionHours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ReceptionHours>
 *
 * @method ReceptionHours|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReceptionHours|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReceptionHours[]    findAll()
 * @method ReceptionHours[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReceptionHoursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReceptionHours::class);
    }

//    /**
//     * @return ReceptionHours[] Returns an array of ReceptionHours objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ReceptionHours
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
