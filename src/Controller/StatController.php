<?php

namespace App\Controller;

use Faker\Factory;
use App\Entity\Region;
<<<<<<< HEAD
use Symfony\Component\HttpFoundation\Request;
=======
use App\Repository\RegionRepository;
>>>>>>> 4ab7fc1af4d58bc11faf4f650bf99b34089072bd
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
     * @Route("/visitr_reg", name="visiteursparregion")
     */
    public function visiteurparregion(Request $request) : Response
    {
        $search = new VisiteurParRegion;
        $form = $this->createForm();
        
  
    }


     * @Route("/region", name="liste_region")
     */
    public function index(RegionRepository $repo)
    {
        $Regions=$repo->findAll();
        return $this->render('stat/liste.html.twig', [
            'controller_name' => 'RegionController',
            'regions' => $Regions
        ]);
    }

}
