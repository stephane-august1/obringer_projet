<?php

namespace App\DataFixtures;

use App\Entity\User;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\Persistence\ObjectManager as PersistenceObjectManager;
use Doctrine\Persistence\ObjectManager as DoctrinePersistenceObjectManager;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(
        DoctrinePersistenceObjectManager $manager
    ) {

        //user admin

        $user = new User();
        $user->setName('admin');
        $user->setEmail('admin@admin.fr');
        $user->setRoles(array('ROLE_ADMIN'));
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'admin'
        ));

        $manager->persist($user);


        //user simple
        $user2 = new User();
        $user2->setName('user');
        $user2->setEmail('user@user.fr');
        $user2->setRoles(array('ROLE_USER'));
        $user2->setPassword($this->passwordEncoder->encodePassword(
            $user2,
            'user'
        ));


        $manager->persist($user2);

        $manager->flush();
    }
}
