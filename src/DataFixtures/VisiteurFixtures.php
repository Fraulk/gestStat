<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Visiteur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class VisiteurFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $faker=Factory::create("fr_FR");

        // for($j = 1; $j <= mt_rand(3,4); $j++){
        //     $visiteur=new Visiteur();
        //     $visiteur->setMatricule();
        // }

        // $manager->flush();
    }
}
