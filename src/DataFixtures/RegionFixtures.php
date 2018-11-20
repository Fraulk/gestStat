<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Region;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class RegionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker=Factory::create("fr_FR");

        //création des regions

            $region=new Region();
            $region->setNom();
            $manager->persist($region);

        
           
        $manager->flush();

    }
}
