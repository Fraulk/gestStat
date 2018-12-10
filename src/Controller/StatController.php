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
     * Sélectionner une région affiche la liste des visiteurs travaillant dans cette region
     * @Route("/visitr_reg", name="visiteursparregion")
     */
    public function visiteurparregion(ObjectManager $manager,Request $request)
    {
        $form = $this->createForm(VisiteurParRegionType::class);
        $form->handleRequest($request);
        dump($request);
        if($form->isSubmitted())
        {
            $postData = $request->request->get('visiteur_par_region');
            $name_value = $postData['reg_nom'];
            //dump($name_value);
            $listevisites = findVisitrTravReg($name_value);

        }
        return $this->render('stat/visiteursregions.html.twig',[
            'form' => $form->createView(),
            //'listevisites' => $listevisites
        ]);
    }


    // grâce au méthode findAll() du repository de Region, on aura la liste de tous les regions
    // on la d'ailleurs définit dans $Regions
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

    
    /**
     * @Route("/nbvisiteursdeleguesreg", name="liste_nb_vis_deleg_reg")
     */
    public function visiteursdeleguesreg(RegionRepository $repo)
    {
        $Regions=$repo->findAll();
        return $this->render('stat/visiteursdeleguesreg.html.twig', [
            'controller_name' => 'VisiteursdeleguesregController',
            'regions' => $Regions,
            'pageCourante' => 'region'
        ]);
    }

    /**
     * @Route("/lien_stat", name="lien_stat")
     */
    public function lienstat()
    {
        return $this->render('stat/lien_stat.html.twig');
    }
    
}
