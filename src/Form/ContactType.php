<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('nom', TextType::class, [
                'label' => 'Votre nom *',
                'attr' => [
                    'placeholder' => 'Votre nom',
                ]
            ])

            ->add('telephone', TelType::class, [
                'label' => 'Votre numéro de téléphone',
                'attr' => [
                    'placeholder' => 'Votre numéro de téléphone',
                ]
            ])
            ->add('mail', EmailType::class, [
                'label' => 'Votre adresse email *',
                'attr' => [
                    'placeholder' => 'Votre adresse email',
                ]
            ])
            ->add('sujet', TextType::class, [
                'label' => 'Le Sujet *',
                'attr' => [
                    'placeholder' => 'Indiquer le sujet',
                ]
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Votre message *',
                'attr' => [
                    'placeholder' => 'Placer votre message',
                ]
            ])
            ->add(
                'envoyer',
                SubmitType::class,
                [

                    'label' => 'envoyer',

                    'attr' => [
                        'class' => 'float-right navig btn-perso btn-outline-success',
                    ]
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
