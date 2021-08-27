<?php

namespace App\Repository;

use App\Entity\LocationDeVoitures;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LocationDeVoitures|null find($id, $lockMode = null, $lockVersion = null)
 * @method LocationDeVoitures|null findOneBy(array $criteria, array $orderBy = null)
 * @method LocationDeVoitures[]    findAll()
 * @method LocationDeVoitures[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocationDeVoituresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LocationDeVoitures::class);
    }

    // /**
    //  * @return LocationDeVoitures[] Returns an array of LocationDeVoitures objects
    //  */

    public function findByVilleDate($prixencharge, $restitution, $date)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.prixencharge = :date')
            ->setParameter('date', $prixencharge)
            ->andWhere('p.restitution = :restitution')
            ->setParameter('restitution', $restitution)
            ->andWhere('p.date = :date')
            ->setParameter('date', $date)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByVilleDatepluscinq($date, $prixencharge, $restitution, $datepluscinq)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.prixencharge = :date')
            ->setParameter('date', $prixencharge)
            ->andWhere('p.restitution = :restitution')
            ->setParameter('restitution', $restitution)
            ->andWhere('p.date = :date')
            ->setParameter('date', $date)
            ->andWhere('p.date <= :datepluscinq')
            ->setParameter('datepluscinq', $datepluscinq)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByVilleDatemoinscinq($date, $prixencharge, $restitution, $datepluscinq)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.prixencharge = :date')
            ->setParameter('date', $prixencharge)
            ->andWhere('p.restitution = :restitution')
            ->setParameter('restitution', $restitution)
            ->andWhere('p.date = :date')
            ->setParameter('date', $date)
            ->andWhere('p.date <= :datepluscinq')
            ->setParameter('datepluscinq', $datepluscinq)
            ->getQuery()
            ->getResult()
            ;
    }

    /*
    public function findOneBySomeField($value): ?LocationDeVoitures
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
