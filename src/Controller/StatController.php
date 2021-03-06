<?php

namespace App\Controller;

use Faker\Factory;
use App\Entity\Region;
use App\Form\VisitrRegPerType;
use App\Form\VisiteurParRegionType;
use App\Repository\RegionRepository;
use App\Repository\VisiteurRepository;
use App\Repository\DepartementRepository;
use App\Repository\SecteurRepository;
use App\Repository\TravaillerRepository;
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

    /**
     * Sélectionner une région et une période ,affiche la liste des visiteurs qui ont commencé à y travailler
     * @Route("/visitr_reg_per", name="visiteursparregionper")
     */
    public function visiteurparregionper(ObjectManager $manager,Request $request,VisiteurRepository $repo)
    {
        $form = $this->createForm(VisitrRegPerType::class);
        $form->handleRequest($request);
        dump($request);
        $listevisiteurs= null;
        if($form->isSubmitted())
        {
            $postData = $request->request->get('visitr_reg_per');
            $name_value = $postData['reg_nom'];
            $datedeb = $postData['date_debut'];
            $datefin = $postData['date_fin'];
            dump($name_value);
            $time2 = strtotime($datedeb);
            $datedeb_value= date('Y-m-d',$time2);
            $time = strtotime($datefin);
            $datefin_value= date('Y-m-d',$time);
            dump($datedeb_value);
            dump($datefin_value);
            
            $listevisiteurs =$repo->findVisitrTravRegPeriode($name_value,$datedeb_value,$datefin_value);
            dump($listevisiteurs);
        }
        return $this->render('stat/visitrscomregper.html.twig',[
            'form' => $form->createView(),
            'listevisiteurs' => $listevisiteurs
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
     * @Route("/nbDelegParRegion.html", name="nbDelegParRegion")
     */
    public function nbDelegParRegion(TravaillerRepository $repo)
    {
        $Delegues=$repo->findNombreDeleguesReg();
        dump($Delegues);
        return $this->render('stat/nbDelegParRegion.html.twig', [
            'controller_name' => 'nbDelegParRegionController',
            'delegues' => $Delegues,
            'pageCourante' => 'listevisdel'
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

    /**
     * @Route("/speedrun", name="api")
     */
    public function speedrunApi()
    {
        $api = file_get_contents('https://www.speedrun.com/api/v1/games');
        $apiDecode = json_decode($api);
        // dump($apiDecode);
        // die();
        return $this->render('stat/apiSpeedrunCom.html.twig', [
            'controller_name'   =>  'ApiController',
            'api'   =>  $apiDecode
        ]);
    }
}
