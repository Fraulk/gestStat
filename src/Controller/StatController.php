<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StatController extends AbstractController
{
    /**
     * @Route("/", name="stat")
     */
    public function home()
    {
        return $this->render('stat/index.html.twig', [
            'controller_name' => 'StatController',
        ]);
    }

}
