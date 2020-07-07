<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Service\MailService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, MailService $mailService, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if ($request->isMethod('POST')) {
            if ($form->isSubmitted() && $form->isValid()) {
                $a = $form->getData();
                //appel du maillingservice pour envoyer le mail au responsable  du site
                //dd($a);
                $b = new MailService();
                // dd($b);
                $b->maillingContact($a, $mailer);
                // dd($mailer);
                // $this->addFlash('success', 'Votre message a été envoyé');
                return $this->redirectToRoute("contact");
            }
        }
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/send", name="send")
     */
    public function contact(Request $request, \Swift_Mailer $mailer)
    {


        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if ($request->isMethod('POST')) {
            if ($form->isSubmitted() && $form->isValid()) {
                $a = $form->getData();
                //appel du maillingservice pour envoyer le mail au responsable  du site
                //dd($a);
                $b = new MailService();
                dd($b);
                $b->maillingContact($a, $mailer);
                $this->addFlash('success', 'Votre message a été envoyé');
                echo 'Votre message a été envoyé';
                return $this->redirectToRoute("home");
            }
        }
        return $this->render('contac/index.html.twig', [
            //'controller_name' => 'HomeController',

            'form' => $form->createView()
        ]);
    }
}
