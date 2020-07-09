<?php

namespace App\Controller;

use App\Entity\Cabinet;
use App\Form\CabinetType;
use App\Repository\CabinetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 * @Route("/cabinet")
 */
class CabinetController extends AbstractController
{
    /**
     * @Route("/admin/", name="cabinet_index", methods={"GET"})
     */
    public function index(CabinetRepository $cabinetRepository): Response
    {
        return $this->render('admin/cabinet/index.html.twig', [
            'cabinets' => $cabinetRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/new", name="cabinet_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cabinet = new Cabinet();
        $form = $this->createForm(CabinetType::class, $cabinet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cabinet);
            $entityManager->flush();

            return $this->redirectToRoute('cabinet_index');
        }

        return $this->render('admin/cabinet/new.html.twig', [
            'cabinet' => $cabinet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/{id}", name="cabinet_show", methods={"GET"})
     */
    public function show(Cabinet $cabinet): Response
    {
        return $this->render('admin/cabinet/show.html.twig', [
            'cabinet' => $cabinet,
        ]);
    }

    /**
     * @Route("/admin/{id}/edit", name="cabinet_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cabinet $cabinet): Response
    {
        $form = $this->createForm(CabinetType::class, $cabinet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cabinet_index');
        }

        return $this->render('admin/cabinet/edit.html.twig', [
            'cabinet' => $cabinet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/{id}", name="cabinet_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Cabinet $cabinet): Response
    {
        if ($this->isCsrfTokenValid('delete' . $cabinet->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cabinet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cabinet_index');
    }
}
