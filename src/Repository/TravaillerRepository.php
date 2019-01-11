<?php

namespace App\Repository;

use App\Entity\Travailler;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Travailler|null find($id, $lockMode = null, $lockVersion = null)
 * @method Travailler|null findOneBy(array $criteria, array $orderBy = null)
 * @method Travailler[]    findAll()
 * @method Travailler[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TravaillerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Travailler::class);
    }


    public function findNombreDeleguesReg()
    {
        return $this->createQueryBuilder('t')
            ->select('r.reg_nom as regNom , r.reg_code as regCode, count(t.id) as nbDelegue')
            ->join('t.tra_reg','r')
            ->andWhere('t.tra_role = :role')
            ->setParameter('role','Délégué')
            ->groupBy('r.reg_code','r.reg_nom')
            ->getQuery()
            ->getResult();
            
    }

    /*
    public function findAllDelegue()
    {
        return $this->createQueryBuilder('t')
            ->select('vis_nom')
            ->join('t.tra_vis', 'v')
            ->andWhere('t.tra_role = Délégué')
            ->groupBy('v.vis_nom')
            ->orderBy('v.vis_nom') 
            ->getQuery()
            ->getResult();
            
             
    }
    */

    // /**
    //  * @return Travailler[] Returns an array of Travailler objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Travailler
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
