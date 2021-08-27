<?php

namespace App\Repository;

use App\Entity\Vol;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vol|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vol|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vol[]    findAll()
 * @method Vol[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VolRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vol::class);
    }

    // /**
    //  * @return Vol[] Returns an array of Vol objects
    //  */

    public function findByVilleDate($date, $depart, $arrivee)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.villeDepart = :depart')
            ->setParameter('depart', $depart)
            ->andWhere('v.villeArrivee = :arrivee')
            ->setParameter('arrivee', $arrivee)
            ->andWhere('v.dateDepart = :date')
            ->setParameter('date', $date)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByVilleDatepluscinq($date, $depart, $arrivee, $datepluscinq)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.villeDepart = :depart')
            ->setParameter('depart', $depart)
            ->andWhere('v.villeArrivee = :arrivee')
            ->setParameter('arrivee', $arrivee)
            ->andWhere('v.dateDepart >= :date')
            ->setParameter('date', $date)
            ->andWhere('v.dateDepart <= :datepluscinq')
            ->setParameter('datepluscinq', $datepluscinq)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByVilleDatemoinscinq($date, $depart, $arrivee, $datemoinscinq)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.villeDepart = :depart')
            ->setParameter('depart', $depart)
            ->andWhere('v.villeArrivee = :arrivee')
            ->setParameter('arrivee', $arrivee)
            ->andWhere('v.dateDepart >= :date')
            ->setParameter('date', $date)
            ->andWhere('v.dateDepart <= :datemoinscinq')
            ->setParameter('datemoinscinq', $datemoinscinq)
            ->getQuery()
            ->getResult()
            ;
    }

    /*
    public function findOneBySomeField($value): ?Vol
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
