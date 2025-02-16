<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('username', TextType::class, [
            'attr' => ['novalidate' => 'novalidate'],
            'constraints' => [
                new NotBlank([
                    'message' => 'Please enter a username',
                ]),
            ],
        ])
        ->add('email', null, [
            'attr' => ['novalidate' => 'novalidate'],
            'constraints' => [
                new NotBlank([
                    'message' => 'Please enter an email address',
                ]),
            ],
        ])
        ->add('roles', ChoiceType::class, [
            'label' => 'Choisir un rôle',
            'choices' => [
                'Médecin' => 'ROLE_MEDECIN',
                'Utilisateur' => 'ROLE_USER',
            ],
            'expanded' => false, // Liste déroulante
            'multiple' => true,  // Permet de sélectionner plusieurs valeurs (même si une seule peut être choisie)
            'data' => ['ROLE_USER'], // Par défaut, l'utilisateur reçoit le rôle 'ROLE_USER'
        ])
        
            ->add('agreeTerms', CheckboxType::class, [
                'attr' => ['novalidate' => 'novalidate'],
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['novalidate' => 'novalidate'],
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
