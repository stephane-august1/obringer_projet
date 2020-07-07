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

        $cabinet = new Cabinet();
        $cabinet->setName('cabinet1');
        $cabinet->setDescription('desc cabinet1');
        $cabinet->setImagesrc('./images/cabinet1.jpg');

        $manager->persist($cabinet);

        $manager->flush();
    }
}
