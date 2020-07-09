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
        $prestations1 = new Prestation();
        $prestations1
            ->setTitle('Pierres chaudes spécial dos')
            ->setPrice(50)
            ->setTime('45 minutes')
            ->setSrcimage('./images/massage-pierre.webp')
            ->setDescription('une description Pierres chaudes spécial dos .....');

        $prestations2 = new Prestation();
        $prestations2
            ->setTitle('Hydrothérapie des mains')
            ->setPrice(40)
            ->setTime('1 heure')
            ->setSrcimage('./images/hydrotherapie2.jpg')
            ->setDescription('description de la prestation Hydrothérapie des mains Arthrose, arthrite, eczéma...');

        $prestations3 = new Prestation();
        $prestations3
            ->setTitle('Consultation phytothérapie et Aromathéra')
            ->setPrice(40)
            ->setTime('1 heure')
            ->setSrcimage('./images/fruit.webp')
            ->setDescription('desc Consultation phytothérapie et Aromathéra');

        $prestations4 = new Prestation();
        $prestations4
            ->setTitle('Naturopathie pour les enfants')
            ->setPrice(30)
            ->setTime('1 heure 30 minutes')
            ->setSrcimage('./images/naturopathie_enfant2.jpg')
            ->setDescription('description de la prestattion Naturopathie pour les enfants');

        $prestations5 = new Prestation();
        $prestations5
            ->setTitle('Consultation de luminothérapie du visage')
            ->setPrice(30)
            ->setTime('1 heure')
            ->setSrcimage('./images/lumino2.jpg')
            ->setDescription('description de la prestation Consultation de luminothérapie du visage');

        $prestations6 = new Prestation();
        $prestations6
            ->setTitle('Séances de méditation chacra')
            ->setPrice(40)
            ->setTime('1 heure')
            ->setSrcimage('./images/chacra2.jpg')
            ->setDescription('description de la prestation Séances de méditation chacra');

        $prestations7 = new Prestation();
        $prestations7
            ->setTitle('Séance de réflexologie')
            ->setPrice(40)
            ->setTime('1 heure 30 minutes ou plus')
            ->setSrcimage('./images/reflexo_plantaire.jpg')
            ->setDescription('description de la prestation Séance de réflexologie');

        $prestations8 = new Prestation();
        $prestations8
            ->setTitle('Consultation en auriculothérapie')
            ->setPrice(40)
            ->setTime('1 heure 30 minutes ou plus')
            ->setSrcimage('./images/auriculotherapie2.jpeg')
            ->setDescription('auriculothérapie sevrage du tabac et perte de poids 80 € un ou 120 € les deux');

        $prestations9 = new Prestation();
        $prestations9
            ->setTitle('Consultation de naturopathie')
            ->setPrice(40)
            ->setTime('1 heure 30 minutes')
            ->setSrcimage('./images/soins.jpg')
            ->setDescription('description de la prestation Consultation de naturopathie');


        $manager->persist($prestations1);
        $manager->persist($prestations2);
        $manager->persist($prestations3);
        $manager->persist($prestations4);
        $manager->persist($prestations5);
        $manager->persist($prestations6);
        $manager->persist($prestations7);
        $manager->persist($prestations8);
        $manager->persist($prestations9);



        $manager->flush();
    }
}
