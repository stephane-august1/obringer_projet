<?php
//service pour les mailling avec swiftmailer

namespace App\Service;

use App\Entity\User;


use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailService
{
    public function maillingContact($a, $mailer)
    {
        $message = (new \Swift_Message("vous avez un nouveau message"))
            ->setFrom('melanie.obr1ger@gmail.com')
            ->setTo('melanie.obr1ger@gmail.com')
            ->setBody(
                "<html>
                    <body>
                        <h1>Nouveau message du site internet</h1>
                            
                            <h2>Message de : " . $a['nom'] .
                    "</h2>
                            <h3>Sujet du message : " . $a['sujet'] . "</h3>
                                <h3>Numéro téléphone : " . $a['telephone'] . "</h3>
                                <h3>Voici le message : " . $a['message'] . "</h3>
                               <p>Pour répondre au email voici son adresse : " . $a['mail'] . "</p>
                            </body>
                          </html>",
                'text/html'
            );
        $mailer->send($message);
    }
}
