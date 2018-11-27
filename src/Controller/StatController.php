<?php

namespace App\Controller;

use Faker\Factory;
use App\Entity\Region;
use App\Form\VisiteurParRegionType;
use App\Repository\RegionRepository;
use App\Repository\DepartementRepository;
use Symfony\Component\HttpFoundation\Request;
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
            'pageCourante'=>"accueil"
        ]);
    }

    /**
     * @Route("/visitr_reg", name="visiteursparregion")
     */
    public function visiteurparregion(ObjectManager $manager,Request $request)
    {
        $form = $this->createForm(VisiteurParRegionType::class);
        $form->handleRequest($request);
        dump($request);
        if($form->isSubmitted())
        {
            $num_reg =$request->request; //->get('reg_nom')
            //dump($num_reg);
            //dump($request->request->get('reg_nom'));
        }

        return $this->render('stat/visiteursregions.html.twig',[
            'form' => $form->createView()
        ]);
    }

    // grâce au méthode findAll() du repository de Region, on aura la liste de tous les regions
    // on la dailleurs définit dans $Regions
    // $Regions qui devient regions
    /** 
     * @Route("/region", name="liste_region")
     */
    public function index(RegionRepository $repo)
    {
        $Regions=$repo->findAll();
        return $this->render('stat/region.html.twig', [
            'controller_name' => 'RegionController',
            'regions' => $Regions,
            'pageCourante'=>"region"
        ]);
    }

    /**
     * @Route("/departement", name="listeDep")
     */
    public function departement(DepartementRepository $repo)
    {
        $Departements=$repo->findAll();
        return $this->render('stat/departement.html.twig', [
            'controller_name' => 'DepartementController',
            'departements' => $Departements,
            'pageCourante' => 'departement'
        ]);
    }

}
