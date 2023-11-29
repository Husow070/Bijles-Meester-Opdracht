<?php

namespace App\Repository;

use App\Entity\Bijles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Bijles>
 *
 * @method Bijles|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bijles|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bijles[]    findAll()
 * @method Bijles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BijlesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bijles::class);
    }

//    /**
//     * @return Bijles[] Returns an array of Bijles objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Bijles
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
