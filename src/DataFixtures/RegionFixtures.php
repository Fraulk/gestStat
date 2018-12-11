<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Region;
use App\Entity\Secteur;
use App\Entity\Visiteur;
use App\Entity\Travailler;
use App\Entity\Departement;
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

            //Creation des departements
            $dep=new Departement();
            $dep->setDepCode("s")
                ->setDepNom( "Swiss");
            $manager->persist($dep);
            $dep1=new Departement();
            $dep1->setDepCode("b")
                 ->setDepNom( "Bourdon");
            $manager->persist($dep1);
            $dep2=new Departement();
            $dep2->setDepCode("a")
                ->setDepNom( "Autre");
            $manager->persist($dep2);
            $depTable = [$dep, $dep1, $dep2];

            //creation des regions
            $regionTable = [];
            foreach ($regions  as $key => $value) {
            $region=new Region();
            $region->setRegCode($value["code"]);
            $region->setRegNom($value["name"]);
            $manager->persist($region);
            $regionTable[] = $region;   //on fout chaque objet region dedans pour definir 'secteur'

                // var_dump($value);
                //creation de visiteur
                for ($i=0; $i < mt_rand(3,8) ; $i++) { 
                    $visitor = new Visiteur();

                    $randDep = mt_rand(0,2);
                    $visitor->setVisMatricule(mt_rand(1000,9999))
                            ->setVisNom($faker->name())
                            ->setVisAdresse($faker->streetaddress())
                            ->setVisCp($faker->postcode())
                            ->setVisVille($faker->city())
                            ->setVisDateembauche($faker->dateTimeBetween('-10 years', 'now'))
                            ->setVisDep($depTable[$randDep]);
                            //->setVisSec($secTable[$randSec]);
                    $manager->persist($visitor);
                    
                    //creation de travailler
                    $visitorTable[] = $visitor;

                }
 

            }

            foreach($visitorTable as $v){
                $travailler = new Travailler();
                $roleTable = ["Visiteur", "Délégué", "Responsable secteur"];
                $travailler->setTraReg($regionTable[mt_rand(0,18)])
                            ->setTraVis($visitorTable[mt_rand(1,$i)])
                            ->setTraDate($faker->dateTimeBetween('-5 years', 'now'))
                            ->setTraRole($roleTable[mt_rand(0,2)]);
                $manager->persist($travailler);
                }

            $secLibTable = ["Nord", "Ouest", "Sud", "Est", "Paris Centre"];
            $secCodeTable = ["n", "o", "s", "e", "pc"];

            //creation de secteur grace au tableau d'ojet region créée auparavant
            foreach ($secLibTable as $value) {
                $i = 0;
                $secteur = new Secteur();
                $secteur->setSecLibelle($value)
                        ->setSecCode($i)
                        ->setRegion($regionTable[mt_rand(0,18)]);
                $manager->persist($secteur);
            }
        $manager->flush();

    }
}
