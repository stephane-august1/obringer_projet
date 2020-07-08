<?php

namespace App\DataFixtures;

use App\Entity\Cabinet;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\Persistence\ObjectManager as PersistenceObjectManager;
use Doctrine\Persistence\ObjectManager as DoctrinePersistenceObjectManager;

class CabinetFixtures extends Fixture
{


    public function __construct()
    {
    }

    public function load(
        DoctrinePersistenceObjectManager $manager
    ) {

        //Cabinet
        for ($i = 1; $i < 5; $i++) {
            $cabinet = 'cabinet' . $i;
            $cabinet = new Cabinet();
            $cabinet->setName('cabinet' . $i);
            $cabinet->setDescription('description du cabinet ' . $i);
            $cabinet->setImagesrc('./images/cabinet' . $i . '.jpg');

            $manager->persist($cabinet);
        }
        $manager->flush();
    }
}
