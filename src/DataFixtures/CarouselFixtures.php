<?php

namespace App\DataFixtures;

use App\Entity\Carousel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CarouselFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $carousel1 = new Carousel();
        $carousel1
            ->setName('carousel1')
            ->setSrcimagecarousel('./images/flower2.jpg')
            ->setDescriptioncarousel('Les plantes')
            ->setTitlecarousel('Les Plantes')
            ->setCategories('carouselactive')
            ->setActive(1);

        $carousel2 = new Carousel();
        $carousel2
            ->setName('carousel2')
            ->setSrcimagecarousel('./images/foot2.jpg')
            ->setDescriptioncarousel('Profitez d\'un massage a petit prix')
            ->setTitlecarousel('Massages De Siam')
            ->setCategories('carousel')
            ->setActive(0);

        $carousel3 = new Carousel();
        $carousel3
            ->setName('carousel3')
            ->setSrcimagecarousel('./images/essential_huile.jpg')
            ->setDescriptioncarousel('Profiter d\'une game de soins aux huiles')
            ->setTitlecarousel('Les plantes')
            ->setCategories('carousel')
            ->setActive(0);


        $manager->persist($carousel1);
        $manager->persist($carousel2);
        $manager->persist($carousel3);

        $manager->flush();
    }
}
