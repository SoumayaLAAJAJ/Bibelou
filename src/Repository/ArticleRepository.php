<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function search($terms){
        return $this->createQueryBuilder('a')
        // où : dans le name de l'article se trouvant dans ArticleRepository définit par 'a' - terms : paramètre donc
            ->where('a.name LIKE :terms')
        //On décrit le paramètre dans la ligne suivante en le concaténant avec % pour rechercher pas seulement selon le terme exacte mais dans tous les titres, ceux qui contiennent le terme recherché
            ->setParameter('terms', '%'.$terms.'%')
        // dans l'ordre alphabétique (ASC : ascendant)
            ->orderBy("a.name", "ASC")
            ->getQuery()
            ->getResult()
            ;

    }

    public function findDisponible(){
        return $this->createQueryBuilder('a')
        ->leftJoin("a.articleInCart", "ac")
        ->where("ac.article is null")
        ->getQuery()
        ->getResult()
        ;

    }

    

    // /**
    //  * @return Article[] Returns an array of Article objects
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
    public function findOneBySomeField($value): ?Article
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


