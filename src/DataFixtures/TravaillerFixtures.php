<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Travailler;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TravaillerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $faker=Factory::create("fr_FR");
        // $travailler = new Travailler();
        // $travailler->setTraReg($regions)
        //            ->setTraVis($visiteur)
        //            ->setTraDate($faker->dateTimeBetween('-6 months'))
        //            ->setTraRole($faker->sentence($nbWords = 4 ,$variableNbWords = true));

        // $manager->flush();
    }
}
