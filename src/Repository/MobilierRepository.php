<?php

namespace App\Repository;

use App\Entity\Mobilier;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Mobilier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mobilier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mobilier[]    findAll()
 * @method Mobilier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MobilierRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Mobilier::class);
    }


     public function findAllVisible($value): ?Mobilier
    {
        return $this->createQueryBuilder('m')
            ->Where('m.solde = :false')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }


    public function findByDate(\DateTime $creation_at)
    {
    	$from = new \DateTime($creation_at->format("y-m-d")." 00:00:00");
    	$to = new \DateTime($creation_at->format("y-m-d")." 23:59:59");

        return $this->createQueryBuilder('j')
            ->andWhere('j.creation_at BETWEEN :from AND :to')
            ->setParameter('from', $from)
            ->setParameter('to', $to)
            ->getQuery()
            ->getResult();


    }



    // /**
    //  * @return Mobilier[] Returns an array of Mobilier objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Mobilier
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
