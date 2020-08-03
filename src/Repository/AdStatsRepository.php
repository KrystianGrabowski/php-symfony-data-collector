<?php

namespace App\Repository;

use App\Entity\AdStats;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AdStats|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdStats|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdStats[]    findAll()
 * @method AdStats[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdStatsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdStats::class);
    }

    // /**
    //  * @return AdStats[] Returns an array of AdStats objects
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
    public function findOneBySomeField($value): ?AdStats
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findByKey($stats): ?AdStats
    {
        return $this->findOneBy([
            'url' => $stats->getUrl(),
            'tags' => $stats->getTags(),
            'date' => $stats->getDate()
        ]);
    }

    public function save($data)
    {
        $entityManager = $this->getEntityManager();
        foreach($data as $stats)
        {
            $duplicate = $this->findByKey($stats);
            if ($duplicate == null)
            {
                $entityManager->persist($stats);
                $entityManager->flush();
            }

        }
    }
}
