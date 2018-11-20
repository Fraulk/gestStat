<?php

namespace App\DataFixtures;

use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class StatFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker=Factory::create("fr_FR");

        $manager->flush();
    }
}
