<?php

namespace App\Controller;

use DateTime;
use App\Entity\Avis;
use App\Entity\User;
use App\Form\AvisType;
use App\Form\UserType;
use App\Repository\AvisRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @IsGranted("ROLE_ADMIN")
 */

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(EntityManagerInterface $em, UserRepository $userRepository)
    {
        return $this->render('admin/index.html.twig', [
            //'controller_name' => 'AdminController',
            'users' => $userRepository->findAll(),
        ]);
    }
    /**
     *
     * @Route("/admin/user", name="admin_index", methods={"GET"})
     *
     */

    public function indexuser(UserRepository $userRepository): Response
    {
        return $this->render('admin/indexuser.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }
    /**
     * @Route("/admin/user/{id}", name="adminuser_show", methods={"GET"})
     *
     *
     */
    public function show(User $user, UserRepository $userRepository, $id): Response
    {


        // recupere uniquement le user en cours de connexion
        // $user = $this->getUser();
        //dd($user);

        return $this->render('admin/adminshow.html.twig', [
            'user' => $user,
            //'user' => $userRepository->findAll(),
        ]);
    }
    /**
     * @Route("/admin/edit/{id}", name="adminuser_edit", methods={"GET","POST"})
     */
    public function edit(
        $id,
        Request $request,
        User $user,
        EntityManagerInterface $manager,
        UserPasswordEncoderInterface $encoder
    ): Response {


        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $user->setRoles(array('ROLE_USER'));
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('admin/adminedit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("admin/new", name="adminuser_new", methods={"GET","POST"})
     */
    public function new(
        Request $request,
        EntityManagerInterface $manager,
        UserPasswordEncoderInterface $encoder
    ): Response {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $user->setRoles(array('ROLE_USER'));
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('admin_index');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("admin/{id}", name="adminuser_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_index');
    }
    /**
     *
     *
     * @Route("/admin/avis/", name="avis_admin_index", methods={"GET"})
     */
    public function avis(AvisRepository $avisRepository): Response
    {

        return $this->render('admin/avis/index.html.twig', [
            'avis' => $avisRepository->findAll(),

        ]);
    }
    /**
     * @Route("/admin/avis/new", name="admin_avis_new", methods={"GET","POST"})
     */
    public function avisnew(Request $request, UserRepository $userRepository): Response
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
     * @Route("/admin/avis/{id}", name="admin_avis_show", methods={"GET"})
     */
    public function avisshow(Avis $avi): Response
    {

        return $this->render('admin/avis/show.html.twig', [
            'avi' => $avi,

        ]);
    }


    /**
     * @Route("/user_avis/{id}", name="admin_avis_one_show", methods={"GET"})
     */
    public function avisoneshow(UserRepository $userRepository, AvisRepository $avisRepository, $id): Response
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
     * @Route("/admin/avis/{id}/edit", name="admin_avis_edit", methods={"GET","POST"})
     */
    public function avisedit(Request $request, Avis $avi): Response
    {

        $form = $this->createForm(AvisType::class, $avi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('home_avis');
        }

        return $this->render('admin/avis/edit.html.twig', [
            'avi' => $avi,
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/{id}", name="admin_avis_delete", methods={"DELETE"})
     */
    public function avisdelete(Request $request, Avis $avi): Response
    {

        if ($this->isCsrfTokenValid('delete' . $avi->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($avi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home_avis');
    }
}
