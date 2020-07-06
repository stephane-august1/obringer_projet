<?php

namespace App\Controller;

use App\Entity\User;
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
}
