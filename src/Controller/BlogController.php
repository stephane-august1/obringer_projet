<?php

namespace App\Controller;

use Datetime;
use App\Entity\Blog;
use App\Form\BlogType;
use App\Repository\BlogRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/blog")
 */
class BlogController extends AbstractController
{
    /**
     * @Route("/", name="blog", methods={"GET"})
     */
    public function blog(BlogRepository $blogRepository): Response
    {
        $user = $this->getUser();
        if ($user == true) {
            $userid = $user->getId($user);
        } else {
            $userid = 'noid';
        }
        $blogs = $blogRepository->findAll();
        //dd($blogs);
        return $this->render('blog/blog.html.twig', [
            'blogs' => $blogs,
            'userid' => $userid,
        ]);
    }

    /**
     *
     * @Route("/admin/blog", name="blog_index", methods={"GET"})
     */
    public function index(BlogRepository $blogRepository): Response
    {
        return $this->render('blog/index.html.twig', [
            'blogs' => $blogRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="blog_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $user = $this->getUser();
        if ($user == true) {
            $blog = new Blog();
            $form = $this->createForm(BlogType::class, $blog);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $blog->setCreatedAt(new Datetime('now'))
                    ->setUser($user);
                // dd($blog);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($blog);
                $entityManager->flush();

                return $this->redirectToRoute('blog');
            }
        } else {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('blog/new.html.twig', [
            'blog' => $blog,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="blog_show", methods={"GET"})
     */
    public function show(Blog $blog): Response
    {
        return $this->render('blog/show.html.twig', [
            'blog' => $blog,
        ]);
    }
    /**
     * @Route("/user_blog/{id}", name="user_oneblog_show", methods={"GET"})
     */
    public function oneblogshow(UserRepository $userRepository, BlogRepository $blogRepository, $id): Response
    {

        // recupere uniquement le user en cours de connexion
        $user = $this->getUser();
        if ($user == true) {
            $userid = $user->getId($user);
        } else {
            return $this->redirectToRoute('app_login');
        }
        // $userid = $user->getId($user);
        // dd($userid);
        // si user est connecter sinon redirection vers login

        $blog = $blogRepository->findBy(
            [
                'user' => $userid
            ]
        );
        // dd($userid);

        return $this->render('blog/oneshow.html.twig', [
            'blog' => $blog,
            'user' => $userid,

        ]);
    }


    /**
     * @Route("/{id}/edit", name="blog_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Blog $blog): Response
    {
        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $blog->getCreatedAt($blog->getCreatedAt());
            $this->getDoctrine()->getManager()->flush();


            return $this->redirectToRoute('blog');
        }

        return $this->render('blog/edit.html.twig', [
            'blog' => $blog,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}/modifier", name="blog_modifier", methods={"GET","POST"})
     */
    public function modifier(Request $request, Blog $blog): Response
    {

        $user = $this->getUser();

        //dd($blogid);
        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);
        if ($user == true) {
            $userid = $user->getId();
            // dd($userid);
            $blogid = $blog->getId();
            if ($userid === $blogid) {

                if ($form->isSubmitted() && $form->isValid()) {
                    $blog->getCreatedAt($blog->getCreatedAt());
                    $this->getDoctrine()->getManager()->flush();


                    return $this->redirectToRoute('blog');
                }
            }
            echo 'pas votre article';
        } else {
            return $this->redirectToRoute('app_login');
        }
        return $this->render('blog/useredit.html.twig', [
            'blog' => $blog,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="blog_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Blog $blog): Response
    {
        if ($this->isCsrfTokenValid('delete' . $blog->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($blog);
            $entityManager->flush();
        }

        return $this->redirectToRoute('blog');
    }
}
