<?php

namespace App\Controller;

use Faker\Factory;
use App\Entity\Region;
use App\Form\VisiteurParRegionType;
use App\Repository\RegionRepository;
use App\Repository\SecteurRepository;
use App\Repository\VisiteurRepository;
use App\Repository\TravaillerRepository;
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
    public function visiteurparregion(ObjectManager $manager,Request $request,VisiteurRepository $repo)
    {
        $form = $this->createForm(VisiteurParRegionType::class);
        $form->handleRequest($request);
        dump($request);
        $listevisites= null;
        if($form->isSubmitted())
        {
            $postData = $request->request->get('visiteur_par_region');
            $name_value = $postData['reg_nom'];
            dump($name_value);
            $listevisites =$repo->findVisitrTravReg($name_value);
            dump($listevisites);
        }
        return $this->render('stat/visiteursregions.html.twig',[
            'form' => $form->createView(),
            'listevisites' => $listevisites
        ]);
    }


    // grâce au méthode findAll() du repository de Region, on aura la liste de tous les regions
    // on la d'ailleurs définit dans $Regions
    // $Regions qui devient regions
    /** 
     * @Route("/region", name="liste_region")
     */
    public function index(RegionRepository $repo/*, SecteurRepository $repoSec*/)
    {
        $Regions=$repo->findAll();
        //$secteurs = $repoSec->findAll();
        return $this->render('stat/region.html.twig', [
            'controller_name' => 'RegionController',
            'regions' => $Regions,
            //'secteurs'  => $secteurs,
            'pageCourante'=>"region"
        ]);
    }

    /**
     * @Route("/nbVisitrParRegion", name="nbVisitrParRegion")
     */
    public function nbVisitrParReg(RegionRepository $repoRegion)
    {
        $Regions=$repoRegion->findAll();
        return $this->render('stat/nbVisitrParRegion.html.twig', [
            'controller_name' => 'RegionController',
            'regions' => $Regions,
            'pageCourante'=>"region"
        ]);
    }

    /**
     * @Route("/nbVisitrParSecteur", name="nbVisitrParSecteur")
     */
    public function nbVisitrParSecteurg(SecteurRepository $repo)
    {
        $Secteur=$repo->findAll();
        return $this->render('stat/nbVisitrParSecteur.html.twig', [
            'controller_name' => 'RegionController',
            'secteurs' => $Secteur,
            'pageCourante'=>"secteur"
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
    public function visiteursdeleguesreg(VisiteurRepository $repoVis, TravaillerRepository $repoTra)
    {
        $Visiteurs=$repoVis->findNombreVisiteursReg();
        $Delegues=$repoTra->findNombreDeleguesReg();
        $AllDelegues=$repoTra->findAllDelegue();
        return $this->render('stat/visiteursdeleguesreg.html.twig', [
            'controller_name' => 'VisiteursdeleguesregController',
            'visiteurs' => $Visiteurs,
            'delegues' => $Delegues,
            'allDelegues' => $AllDelegues,
            'pageCourante' => 'listevisdel'
        ]);
    }

    /**
     * @Route("/lien_stat", name="lien_stat")
     */
    public function lienstat()
    {
        return $this->render('stat/lien_stat.html.twig');
    }
    

    /**
     * @Route("/testApi", name="api")
     */
    public function api_decode()
    {
        $api = file_get_contents('https://geo.api.gouv.fr/regions?fields=nom,code');
        $apiDecode = json_decode($api);
        // dump($apiDecode);
        // die();
        return $this->render('stat/testApi.html.twig', [
            'controller_name'   =>  'ApiController',
            'api'   =>  $apiDecode,
            'pageCourante'  =>  'api'
        ]);

    }

}
