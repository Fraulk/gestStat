<?php

namespace App\Repository;

use App\Entity\Visiteur;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Validator\Constraints\DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Visiteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Visiteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Visiteur[]    findAll()
 * @method Visiteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VisiteurRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Visiteur::class);
    }

    // /**
    //  * @return Visiteur[] Returns an array of Visiteur objects
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
    public function findNombreVisiteursReg()
    {
        
        
            
        return $this->createQueryBuilder('v')
            ->select('r.reg_nom, count(v.id)')
            ->join('v.travaillers', 't')
            ->join('t.tra_reg','r')
            ->groupBy('r')
            ->orderBy('r.reg_code')
            ->getQuery()
            ->getResult()
            ;


            /*->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->setMaxResults(10)
            */
            
    

    /*
    public function findOneBySomeField($value): ?Visiteur
    {
        return $this->createQueryBuilder('v')
        ->andWhere('v.exampleField = :val')
        ->setParameter('val', $value)
        ->getQuery()
        ->getOneOrNullResult()
        ;
    }
    */
        
    public function findVisitrTravReg($numregion)
    {
        return $this->createQueryBuilder('v')
                    ->join('v.travaillers', 't')
                    ->andWhere('t.tra_reg = :val')
                    ->setParameter('val', $numregion)
                    ->getQuery()
                    ->getResult();
    }

    /**visiteurs qui ont commencé à travailler 
    ** dans une région donnée 
    ** et une période
    */
    public function findVisitrTravRegPeriode($numregion, $datedeb, $datefin)
    {
        return $this->createQueryBuilder('v')
                    ->join('v.travaillers', 't')
                    ->Where('t.tra_reg = :val')
                    ->andwhere('v.vis_dateembauche BETWEEN :datedeb AND :datefin')
                    ->setParameter('val', $numregion)
                    ->setParameter('datedeb', $datedeb)
                    ->setParameter('datefin', $datefin)
                    ->getQuery()
                    ->getResult();
    }
}
