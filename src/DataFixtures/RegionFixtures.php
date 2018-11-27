<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Region;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class RegionFixtures extends Fixture
{

    /**
     * charge les régions de france à partir d'un fichier csv
     *
     * @return $regions tableau
     */
    public function chargercsvregion(){
        //lire le fichier csv
        $regions = array();
        $row = 1;
        //if(($handle = fopen("C:\\laragon\\www\\gestStat\\src\\DataFixtures\\regions.csv", "r")) !== FALSE){   //frat
        if(($handle = fopen("src\\DataFixtures\\regions.csv", "r")) !== FALSE){
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
        return $regions;
    }


    
    public function load(ObjectManager $manager)
    {
        $faker=Factory::create("fr_FR");

            $regions = $this->chargercsvregion();
            // echo "<pre>";
            // var_dump($regions);
            // echo "</pre>";
            // die();
            foreach ($regions  as $key => $value) {
                $region=new Region();
                $region->setRegCode($value["code"]);
                $region->setRegNom($value["name"]);
                $manager->persist($region);
                // var_dump($value);
            }
        $manager->flush();

    }
}
