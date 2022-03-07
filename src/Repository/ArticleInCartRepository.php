<?php

namespace App\Repository;

use App\Entity\ArticleInCart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArticleInCart|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleInCart|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleInCart[]    findAll()
 * @method ArticleInCart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleInCartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticleInCart::class);
    }

    // /**
    //  * @return ArticleInCart[] Returns an array of ArticleInCart objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ArticleInCart
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
