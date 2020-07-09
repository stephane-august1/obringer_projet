<?php

namespace App\Controller;

use App\Repository\PrestationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class PrestationsController extends AbstractController
{
    /**
     * @Route("/prestations",name="prestations")
     */
    public function index(PrestationRepository $prestationRepository)
    {
        $prestations = $prestationRepository->findAll();

        return $this->render('prestations/index.html.twig', [
            'prestations' => $prestations,
        ]);
    }
}
