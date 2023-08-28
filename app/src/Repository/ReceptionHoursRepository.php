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

    public function findFreeDates($busyTimes)
   {
        $qb = $this->createQueryBuilder('r')
           ->select('r.time');
           if($busyTimes) {
            $qb
                ->andWhere('r.id NOT IN (:ids)')
                ->setParameter('ids', $busyTimes);
           }
           $query = $qb->getQuery();
           
       return $query->execute();
   }
}
