<?php

namespace App\Repository;

use App\Entity\SecondCarousel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SecondCarousel|null find($id, $lockMode = null, $lockVersion = null)
 * @method SecondCarousel|null findOneBy(array $criteria, array $orderBy = null)
 * @method SecondCarousel[]    findAll()
 * @method SecondCarousel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SecondCarouselRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SecondCarousel::class);
    }

    // /**
    //  * @return SecondCarousel[] Returns an array of SecondCarousel objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SecondCarousel
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
