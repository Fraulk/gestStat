<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Region;
use App\Entity\Secteur;
use App\Entity\Visiteur;
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

                $sec = new Secteur();
                $sec->setSecCode("Nord")
                    ->setSecLibelle("n");
                $manager->persist($sec);
                $sec1 = new Secteur();
                $sec1->setSecCode("Ouest")
                     ->setSecLibelle("o");
                $manager->persist($sec1);
                $sec2 = new Secteur();
                $sec2->setSecCode("Sud")
                     ->setSecLibelle("s");
                $manager->persist($sec2);
                $sec3 = new Secteur();
                $sec3->setSecCode("Est")
                     ->setSecLibelle("e");
                $manager->persist($sec3);
                $sec4 = new Secteur();
                $sec4->setSecCode("Paris Centre")
                     ->setSecLibelle("pc");
                $manager->persist($sec4);
                $secTable = [$sec, $sec1, $sec2, $sec3, $sec4];
                
            foreach ($regions  as $key => $value) {


                $region=new Region();
                $region->setRegCode($value["code"]);
                $region->setRegNom($value["name"]);
                $manager->persist($region);
                // var_dump($value);
                for ($i=0; $i < mt_rand(3,8) ; $i++) { 
                    $visitor = new Visiteur();

                    $randSec = mt_rand(0,4);
                    $randDep = mt_rand(0,2);
                    $visitor->setVisMatricule(mt_rand(1000,9999))
                            ->setVisNom($faker->name())
                            ->setVisAdresse($faker->streetaddress())
                            ->setVisCp($faker->postcode())
                            ->setVisVille($faker->city())
                            ->setVisDateembauche($faker->dateTimeBetween('-10 years', 'now'))
                            ->setVisDep($depTable[$randDep])
                            ->setVisSec($secTable[$randSec]);
                    $manager->persist($visitor);
                }
            }
        $manager->flush();

    }
}
