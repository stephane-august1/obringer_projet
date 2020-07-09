<?php

namespace App\Controller;

use DateTime;
use App\Entity\Avis;
use App\Entity\User;
use App\Form\AvisType;
use App\Repository\AvisRepository;
use App\Repository\UserRepository;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/avis")
 * /**
 * @IsGranted("ROLE_USER")
 */

class AvisController extends AbstractController
{

    /**
     *@IsGranted("ROLE_USER")
     *
     * @Route("/avis", name="avis_index", methods={"GET"})
     */
    public function index(AvisRepository $avisRepository): Response
    {

        return $this->render('avis/index.html.twig', [
            'avis' => $avisRepository->findAll(),

        ]);
    }

    /**
     * @Route("/new", name="avis_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserRepository $userRepository, SessionInterface $session): Response
    {
        // recupere uniquement le user en cours de connexion
        $user = $this->getUser();
        // si user est connecter sinon redirection vers login
        if ($user == true) {
            // dd($user);
            $avi = new Avis();

            $form = $this->createForm(AvisType::class, $avi);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                //  $user = $session->getUser();
                $avi->setUser($user);
                $avi->setDate(new dateTime('now'));
                $entityManager->persist($avi);
                $entityManager->flush();

                return $this->redirectToRoute('home_avis');
            }
        } else {
            return $this->redirectToRoute('login');
        }
        return $this->render('avis/new.html.twig', [
            'avi' => $avi,
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/{id}", name="avis_show", methods={"GET"})
     */
    public function show(Avis $avi): Response
    {

        return $this->render('avis/show.html.twig', [
            'avi' => $avi,

        ]);
    }


    /**
     * @Route("/user_avis/{id}", name="avis_one_show", methods={"GET"})
     */
    public function oneshow(UserRepository $userRepository, AvisRepository $avisRepository, $id): Response
    {

        // recupere uniquement le user en cours de connexion
        $user = $this->getUser();
        $userid = $user->getId($user);
        //dd($user);
        // si user est connecter sinon redirection vers login

        $avis = $avisRepository->findBy(
            [
                'user' => $id
            ]
        );
        if ($userid != $id) {
            return $this->redirectToRoute('error404');
        } else {
            return $this->render('avis/oneshow.html.twig', [
                'avis' => $avis,

            ]);
        }
    }

    /**
     * @Route("/{id}/edit", name="avis_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Avis $avi): Response
    {

        $form = $this->createForm(AvisType::class, $avi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('home_avis');
        }

        return $this->render('avis/edit.html.twig', [
            'avi' => $avi,
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/{id}", name="avis_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Avis $avi): Response
    {

        if ($this->isCsrfTokenValid('delete' . $avi->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($avi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home_avis');
    }
}
