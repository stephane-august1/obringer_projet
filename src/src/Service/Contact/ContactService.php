<?php


namespace App\Service\Contact;

use App\Form\ContactType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ContactService
{
    private $form;
    private $router;
    private $formFactory;

    public function __construct(UrlGeneratorInterface $router, FormFactoryInterface $formFactory)
    {
        $this->router = $router;
        $this->formFactory = $formFactory;
        $this->form = $this->formFactory->create(
            ContactType::class,
            null,
            array(
                'attr' => array('action' => $this->router->generate('contact'))
            )
        );
    }

    public function getForm()
    {
        return $this->form;
    }
}
