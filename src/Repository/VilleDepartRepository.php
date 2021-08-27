<?php

namespace App\Repository;

use App\Entity\VilleDepart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VilleDepart|null find($id, $lockMode = null, $lockVersion = null)
 * @method VilleDepart|null findOneBy(array $criteria, array $orderBy = null)
 * @method VilleDepart[]    findAll()
 * @method VilleDepart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VilleDepartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VilleDepart::class);
    }

    // /**
    //  * @return VilleDepart[] Returns an array of VilleDepart objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VilleDepart
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
