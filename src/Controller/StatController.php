<?php

namespace App\Controller;

use Faker\Factory;
use App\Entity\Region;
use App\Repository\RegionRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StatController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function home()
    {
        
        return $this->render('stat/index.html.twig', [
            'controller_name' => 'StatController',
        ]);
    }

    /**
     * @Route("/region", name="liste_region")
     */
    public function index(RegionRepository $repo)
    {
        $Regions=$repo->findAll();
        return $this->render('stat/region.html.twig', [
            'controller_name' => 'RegionController',
            'regions' => $Regions
        ]);
    }

    /**
     * @Route("/departement", name="listeDep")
     */
    public function departement(RegionRepository $repo)
    {
        $Departements=$repo->findAll();
        return $this->render('stat/departement.html.twig', [
            'controller_name' => 'DepartementController',
            'departements' => $Departements
        ]);
    }

}
