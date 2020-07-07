<?php

namespace App\Form;

use App\Entity\Avis;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AvisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('qualite', ChoiceType::class, [
                'required'   => true,
                'label' => ' * notez la qualite des services',
                'choices'  => [
                    '0' => 0,
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                ],
            ])
            ->add('delais', ChoiceType::class, [
                'required'   => true,
                'label' => ' * notez les delais',
                'choices'  => [
                    '0' => 0,
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                ],
            ])
            ->add('expertise', ChoiceType::class, [
                'required'   => true,
                'label' => 'notez  l\'expertise',
                'choices'  => [
                    '0' => 0,
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                ],
            ])
            ->add('prix', ChoiceType::class, [
                'required'   => true,
                'label' => ' * notez les prix',
                'choices'  => [
                    '0' => 0,
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                ],

            ])

            ->add('produitconcerne', TextareaType::class, [
                'required'   => true,
                'label' => ' * La prestation concernée',
                'help' => 'The ZIP/Postal code for your credit card\'s billing address.',


            ])

            ->add('details', TextareaType::class, [

                'required'   => true,
                'label' => ' * Les détails de votre avis',

            ]);
        //->add('date') on gere la date dans le controleur

        //->add('user'); on insere le user dans le controleur
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Avis::class,
        ]);
    }
}
