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
            ->setFrom('testermailaugust1@gmail.com')
            ->setTo('testermailaugust1@gmail.com')
            ->setBody(
                "<html>
                    <body>
                        <h1>vous avez un nouveau message de</h1>
                            <p>Sujet du message :" . $a['sujet'] . "</p>
                            <h2>le nom:" . $a['nom'] . "</h2>
                                <h2>le telephone:" . $a['telephone'] . "</h2>
                                <p>Voici le message :" . $a['message'] . "</p>
                               <h3>pour reponce a ce email voici sont adresse email :" . $a['mail'] . "</h3>
                            </body>
                          </html>",
                'text/html'
            );
        $mailer->send($message);
    }
}
