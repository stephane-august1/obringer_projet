<?php

namespace App\Controller;

use App\Entity\Carousel;
use App\Form\CarouselType;
use App\Repository\CarouselRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 * @Route("/carousel")
 */
class CarouselController extends AbstractController
{
    /**
     * @Route("/admin/carousel", name="carousel_index", methods={"GET"})
     */
    public function index(CarouselRepository $carouselRepository): Response
    {
        $carousels = $carouselRepository->findAll();

        return $this->render('admin/carousel/index.html.twig', [
            'carousels' => $carousels,

        ]);
    }

    /**
     * @Route("/admin/carousel/new", name="carousel_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $carousel = new Carousel();
        $form = $this->createForm(CarouselType::class, $carousel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($carousel);
            $entityManager->flush();

            return $this->redirectToRoute('carousel_index');
        }

        return $this->render('admin/carousel/new.html.twig', [
            'carousel' => $carousel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/carousel/{id}", name="carousel_show", methods={"GET"})
     */
    public function show(Carousel $carousel): Response
    {
        return $this->render('admin/carousel/show.html.twig', [
            'carousel' => $carousel,
        ]);
    }

    /**
     * @Route("/admin/carousel/{id}/edit", name="carousel_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Carousel $carousel): Response
    {
        $form = $this->createForm(CarouselType::class, $carousel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('carousel_index');
        }

        return $this->render('admin/carousel/edit.html.twig', [
            'carousel' => $carousel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/carousel/{id}", name="carousel_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Carousel $carousel): Response
    {
        if ($this->isCsrfTokenValid('delete' . $carousel->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($carousel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('carousel_index');
    }
}
