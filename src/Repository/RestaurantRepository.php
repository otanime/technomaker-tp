<?php

namespace App\Repository;

use App\Entity\Restaurant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Restaurant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Restaurant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Restaurant[]    findAll()
 * @method Restaurant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RestaurantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Restaurant::class);
    }

    // /**
    //  * @return Restaurant[] Returns an array of Restaurant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Restaurant
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    public function lastRestaurants(int $limit)
    {
        $qb = $this->createQueryBuilder('r')
            ->orderBy('r.created_at', 'DESC')
            ->setMaxResults($limit);


        $query = $qb->getQuery();

        return $query->execute();
    }

    public function ratingAvg(int $id){

        $qb = $this->createQueryBuilder('r')
            ->select('avg(re.rating) as rating')
            ->innerJoin('r.reviews', 're')
            ->where("r.id = $id")
            ->orderBy('r.created_at', 'DESC');

        $query = $qb->getQuery()->getSingleScalarResult();

        return $query;

    }

    public function topRestaurant(int $limit){

        $qb = $this->createQueryBuilder('r')
            ->select('r')
            ->innerJoin('r.reviews', 're')
            ->groupBy('r.id')
            ->orderBy('avg(re.rating)', 'DESC')
            ->setMaxResults($limit);


        $query = $qb->getQuery();

        return $query->execute();

    }

    public function byRating(){

        $qb = $this->createQueryBuilder('r')
            ->select('r')
            ->leftJoin('r.reviews', 're')
            ->groupBy('r.id')
            ->orderBy('avg(re.rating)', 'DESC');

        $query = $qb->getQuery();

        return $query->execute();

    }
}
