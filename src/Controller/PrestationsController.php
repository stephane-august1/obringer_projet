<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class PrestationsController extends AbstractController
{
    /** 
     * @Route("/prestations", name="prestations")
     */
    public function index()
    {
        return $this->render('prestations/index.html.twig', [
            //'controller_name' => 'PrestationsController',
        ]);
    }
}
