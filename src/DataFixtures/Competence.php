<?php

namespace App\DataFixtures;

use App\Entity\Competences;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Competence extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i<count($data);$i++) {
            $competences = new Competences();
            $competences->setNom($data[$i]);
            $manager->persist($competences);
        }
        $manager->flush();
    }

}
