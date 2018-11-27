<?php

namespace App\Controller;

use Faker\Factory;
use App\Entity\Region;
use App\Form\VisiteurParRegionType;
use App\Repository\RegionRepository;
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
            $num_reg =$request->request->get('reg_nom');
            dump($request->request);
        }

        return $this->render('stat/visiteursregions.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /** 
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
