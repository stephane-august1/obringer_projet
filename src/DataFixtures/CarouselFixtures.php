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
            ->setSrcimagecarousel('./images/carousel1.jpg')
            ->setDescriptioncarousel('desc carousel1')
            ->setTitlecarousel('title carousel1')
            ->setCategories('carouselactive')
            ->setActive(1);

        $carousel2 = new Carousel();
        $carousel2
            ->setName('carousel2')
            ->setSrcimagecarousel('./images/carousel2.jpg')
            ->setDescriptioncarousel('desc carousel2')
            ->setTitlecarousel('title carousel2')
            ->setCategories('carousel')
            ->setActive(0);

        $carousel3 = new Carousel();
        $carousel3
            ->setName('carousel3')
            ->setSrcimagecarousel('./images/carousel3.jpg')
            ->setDescriptioncarousel('desc carousel3')
            ->setTitlecarousel('title carousel3')
            ->setCategories('carousel')
            ->setActive(0);


        $manager->persist($carousel1);
        $manager->persist($carousel2);
        $manager->persist($carousel3);

        $manager->flush();
    }
}
