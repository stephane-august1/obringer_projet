<?php

namespace App\DataFixtures;

use DateTime;


use App\Entity\Avis;
use App\Entity\Blog;
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
        $user1 = new User();
        $user1->setName('Mélanie');
        $user1->setEmail('melanie.obr1ger@gmail.com');
        $user1->setRoles(array('ROLE_ADMIN'));
        $user1->setPassword($this->passwordEncoder->encodePassword(
            $user1,
            'obr1melanie'
        ));

        $manager->persist($user);
        $manager->persist($user1);

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
        for ($k = 1; $k <= mt_rand(1, 3); $k++) {
            $avis = new Avis();
            $avis->setQualite(rand(0, 5));
            $avis->setDelais(rand(0, 5));
            $avis->setExpertise(rand(0, 5));
            $avis->setPrix(rand(0, 5));
            $avis->setDetails('détail de l\'experience numéro :' . $k);
            $avis->setDate(new dateTime(rand('-6', '-1')));
            $avis->setProduitconcerne('le produit est bien');
            /****a quel user apartient l'avis  ****/
            $avis->setUser($user2);
            $manager->persist($avis);

            for ($j = 1; $j <= mt_rand(3, 4); $j++) {
                $blog = new Blog();
                $blog
                    ->setTitle('titre ' . $j . 'blogue')
                    ->setImagesrc('essential-oils.png')
                    ->setTexte(' <p>Lorem ipsum dolor sit amet <br>
                 consectetur adipisicing elit. Tempora nostrum 
                facilis repudiandae<p>')
                    ->setCreatedAt(new dateTime(rand('-6', '-1')))
                    ->setUser($user2);

                $manager->persist($blog);
            }
        }



        $manager->flush();
    }
}
