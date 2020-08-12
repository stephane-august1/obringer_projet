<?php

namespace App\Controller;

use App\Form\ContactType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $a = $form->getData();
            $mail = $a['mail'];
            $mess = "<html>
                    <body>
                        <h1>Nouveau message du site internet</h1>
                            
                            <h2>Message de : " . $a['nom'] .
                "</h2>
                            <h3>Sujet du message : " . $a['sujet'] . "</h3>
                                <h3>Numéro téléphone : " . $a['telephone'] . "</h3>
                                <h3>Voici le message : " . $a['message'] . "</h3>
                               <p>Pour répondre au email voici son adresse : " . $a['mail'] . "</p>
                            </body>
                          </html>";
            //appel du maillingservice pour envoyer le mail au responsable  du site
            // dd($a);
            $message = (new \Swift_Message('message du site Internet'));
            $message->setFrom('melanie@obringer-melanie-naturopathe.fr');
            $message->setTo('melanie.obr1ger@gmail.com');
            $message->setBody(
                $mess,
                'text/html'
            );
            // $b = new MailService();
            // dd($message);
            $mailer->send($message);

            $this->addFlash('message', 'votre message a bien été envoyé');

            // $b->maillingContact($a, $mailer);
            // dd($mailer);
            // $this->addFlash('success', 'Votre message a été envoyé');
            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/index.html.twig', [

            'form' => $form->createView()
        ]);
    }
}
