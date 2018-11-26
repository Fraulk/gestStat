<?php

namespace App\Controller;

use Faker\Factory;
use App\Entity\Region;
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
    public function visiteurparregion(Request $request) : Response
    {
        $search = new VisiteurParRegion;
        $form = $this->createForm();
        
  
    }


}
