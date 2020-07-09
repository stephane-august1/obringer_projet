<?php

namespace App\Controller;

use App\Entity\Prestation;
use App\Form\PrestationType;
use App\Repository\PrestationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 * @Route("/prestation")
 */
class PrestationController extends AbstractController
{
    /**
     * @Route("/admin/prestation", name="prestation_index", methods={"GET"})
     */
    public function index(PrestationRepository $prestationRepository): Response
    {
        return $this->render('admin/prestation/index.html.twig', [
            'prestations' => $prestationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/new", name="prestation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $prestation = new Prestation();
        $form = $this->createForm(PrestationType::class, $prestation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($prestation);
            $entityManager->flush();

            return $this->redirectToRoute('prestation_index');
        }

        return $this->render('admin/prestation/new.html.twig', [
            'prestation' => $prestation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/{id}", name="prestation_show", methods={"GET"})
     */
    public function show(Prestation $prestation): Response
    {
        return $this->render('admin/prestation/show.html.twig', [
            'prestation' => $prestation,
        ]);
    }

    /**
     * @Route("/admin/{id}/edit", name="prestation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Prestation $prestation): Response
    {
        $form = $this->createForm(PrestationType::class, $prestation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('prestation_index');
        }

        return $this->render('admin/prestation/edit.html.twig', [
            'prestation' => $prestation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/{id}", name="prestation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Prestation $prestation): Response
    {
        if ($this->isCsrfTokenValid('delete' . $prestation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($prestation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('prestation_index');
    }
}
