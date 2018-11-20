<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Region;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class RegionFixtures extends Fixture
{

    public function chargercsvregion(){
        //lire le fichier csv
        $regions = array();
        $row = 1;
        if(($handle = fopen("C:\\laragon\\www\\geststats\\src\\Controller\\regions.csv", "r")) !== FALSE){
            while ( ($data = fgetcsv($handle,1000, ",")) !== FALSE){
                    $regions[$row] = array(
                            "id" => $data[0],
                            "code" => $data[1],
                            "name" => $data[2],
                            "slug" => $data[3]
                    );
                $row++;
            }
            fclose($handle);
        }
        var_dump($regions);
        die();
    }

    public function load(ObjectManager $manager)
    {
        $faker=Factory::create("fr_FR");

            $region=new Region();
            $region->setNom();
            $manager->persist($region);
            
        
           
        $manager->flush();

    }
}
