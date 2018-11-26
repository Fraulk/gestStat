<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Departement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class DepartementFixtures extends Fixture
{
    /**
     * charge les régions de france à partir d'un fichier csv
     *
     * @return $regions tableau
     */
    public function chargercsvdepartement(){
        //lire le fichier csv
        $regions = array();
        $row = 1;
        if(($handle = fopen("C:\\laragon\\www\\gestStat\\src\\DataFixtures\\departments.csv", "r")) !== FALSE){
            while ( ($data = fgetcsv($handle,1000, ",")) !== FALSE){
                    $departements[$row] = array(
                            "id" => $data[0],
                            "code" => $data[1],
                            "name" => $data[2],
                            "slug" => $data[3]
                    );
                $row++;
            }
            fclose($handle);
        }
        return $departements;
    }


    public function load(ObjectManager $manager)
    {
        $faker=Factory::create("fr_FR");

            $departements = $this->chargercsvdepartement();
            // echo "<pre>";
            // var_dump($regions);
            // echo "</pre>";
            // die();
            foreach ($departements as $key => $value) {
                $departement=new Departement();
                $departement->setDepChefvente($faker->name());
                $departement->setDepCode($value["code"]);
                $departement->setDepNom($value["name"]);
                $manager->persist($departement);
                // var_dump($value);
            }
        $manager->flush();

    }
}
