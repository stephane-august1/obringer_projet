<?php

namespace App\Controller;

use App\Entity\Image;
use App\Repository\ImageRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PhotoController extends AbstractController
{
    /**
     * @Route("/photo", name="photo")
     */
    public function index(ImageRepository $imageRepository)
    {

        $images = $imageRepository->findAll();
        return $this->render('photo/index.html.twig', [
            'images' =>
            $images,
        ]);
    }
}
