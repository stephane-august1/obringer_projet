<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\AvisRepository;
use App\Repository\CabinetRepository;


use App\Repository\CarouselRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(CarouselRepository $carouselRepository): Response
    {
        $carouselactive = $carouselRepository->findBy(['active' => 1]);

        $carousel =  $carouselRepository->findBy(['active' => 0]);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'carousel' => $carousel,
            'carouselactive' => $carouselactive

        ]);
    }
    /**
     * @Route("/cabinet", name="cabinet", methods={"GET"})
     */
    public function cabinet(CabinetRepository $cabinetRepository): Response
    {
        return $this->render('cabinet/index.html.twig', [
            'cabinets' => $cabinetRepository->findAll(),
        ]);
    }
    /**
     *  
     * @Route("/les_avis", name="home_avis")
     */
    public function avis(AvisRepository $avisRepository)
    {
        // $totalArticle = $cartService->getTotalArticle();
        // recupere uniquement le user en cours de connexion
        // $user = $this->getUser();
        // si user est connecter sinon redirection vers login
        // if ($user == true) {


        $avis = $avisRepository->findAll();
        //dd($avis);
        // } else {
        //     return $this->redirectToRoute('erreur_avis');
        // }
        return $this->render('home/avis.html.twig', [

            'avis' => $avis,
            //'carouselactive' => $carouselactive,
            //'totalarticle' => $totalArticle,
        ]);
    }
}
