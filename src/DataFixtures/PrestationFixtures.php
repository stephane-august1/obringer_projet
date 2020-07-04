<?php

namespace App\DataFixtures;

use App\Entity\Prestation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PrestationFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $prestations = new Prestation();
        $prestations->setTitle('titre')
            ->setPrice(45)
            //$prestations->setDescription('decription';
            ->setTime('1heure 45minutes')
            ->setDescription('une description')
            ->setSrcimage('/images/test.png');
        // setSrcimage


        $manager->persist($prestations);

        $manager->flush();
    }
}
