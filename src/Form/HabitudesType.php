<?php

namespace App\Form;

use App\Entity\Habitudes;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\NotBlank;

class HabitudesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom de l\'habitude',
                'attr' => ['novalidate' => 'novalidate'], // Désactive la validation HTML5
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le nom de l\'habitude ne peut pas être vide.',
                    ])
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description de l\'habitude',
                'attr' => ['novalidate' => 'novalidate'], // Désactive la validation HTML5
                'constraints' => [
                    new NotBlank([
                        'message' => 'La description de l\'habitude ne peut pas être vide.',
                    ])
                ],
            ])
            ->add('categorie', ChoiceType::class, [
                'label' => 'Catégorie de l\'habitude',
                'choices' => [
                    'Régime équilibré' => 'Régime équilibré',
                    'Hydratation' => 'Hydratation',
                    'Réduction du sucre' => 'Réduction du sucre',
                    'Augmentation des fibres' => 'Augmentation des fibres',
                ],
                'attr' => ['novalidate' => 'novalidate'], // Désactive la validation HTML5
                'constraints' => [
                    new NotBlank([
                        'message' => 'La catégorie de l\'habitude ne peut pas être vide.',
                    ])
                ],
            ])
            ->add('dateDebut', DateType::class, [
                'label' => 'Date de début',
                'widget' => 'single_text',
                'attr' => ['novalidate' => 'novalidate'], // Désactive la validation HTML5
                'constraints' => [
                    new NotBlank([
                        'message' => 'La date de début ne peut pas être vide.',
                    ])
                ],
            ])
            ->add('dateFin', DateType::class, [
                'label' => 'Date de fin',
                'widget' => 'single_text',
                'attr' => ['novalidate' => 'novalidate'], // Désactive la validation HTML5
                'constraints' => [
                    new NotBlank([
                        'message' => 'La date de fin ne peut pas être vide.',
                    ])
                ],
            ])
            ->add('statut', ChoiceType::class, [
                'label' => 'Statut',
                'choices' => [
                    'Active' => 'Active',
                    'Inactive' => 'Inactive',
                ],
                'attr' => ['novalidate' => 'novalidate'], // Désactive la validation HTML5
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le statut ne peut pas être vide.',
                    ])
                ],
            ]);
               }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Habitudes::class,
        ]);
    }
}
