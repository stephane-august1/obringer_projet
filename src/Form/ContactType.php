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
                'required' => true,
                'label' => 'Votre nom *',
                'attr' => [
                    'placeholder' => 'nom',
                ]
            ])

            ->add('telephone', TelType::class, [
                'required' => false,
                'label' => 'Votre numéro de téléphone',
                'attr' => [
                    'placeholder' => 'téléphone',
                ]
            ])
            ->add('mail', EmailType::class, [
                'required' => true,
                'label' => 'Votre adresse email *',
                'attr' => [
                    'placeholder' => 'Votre email',
                ]
            ])
            ->add('sujet', TextType::class, [
                'required' => true,
                'label' => 'Le Sujet *',
                'attr' => [
                    'placeholder' => 'le sujet',
                ]
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Votre message *',
                'attr' => [
                    'placeholder' => 'Votre message',
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
