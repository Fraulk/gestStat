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
        return $regions;
    }

    public function load(ObjectManager $manager)
    {
        $faker=Factory::create("fr_FR");

            $regions = $this->chargercsvregion();

            foreach ($regions  as $key => $value) {
                $region=new Region();
                $region->setRegNom($value[2]);
                $manager->persist($region);
            }
        $manager->flush();

    }
}
