<?php

namespace App\Repository;

use App\Entity\AdStatsSettings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AdStatsSettings|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdStatsSettings|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdStatsSettings[]    findAll()
 * @method AdStatsSettings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdStatsSettingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdStatsSettings::class);
    }

    // /**
    //  * @return AdStatsSettings[] Returns an array of AdStatsSettings objects
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
    public function findOneBySomeField($value): ?AdStatsSettings
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findByAll($settings): ?AdStatsSettings
    {
        return $this->findOneBy([
            'currency' => $settings->getCurrency(),
            'period_length' => $settings->getPeriodLength()]
        );
    }

    public function save($settings): int
    {
        $entityManager = $this->getEntityManager();
        $duplicate = $this->findByAll($settings);
        if ($duplicate == null)
        {
            $entityManager->persist($settings);
            $entityManager->flush();
            return $settings->getId();
        }
        else 
        {
            return $duplicate->getId();
        }
    }
}
