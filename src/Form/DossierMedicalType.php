<?php

namespace App\Form;

use App\Entity\DossierMedical;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\NotBlank;

class DossierMedicalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('typemaladie', TextType::class, [
                'label' => 'Type de Maladie',
                'attr' => ['novalidate' => 'novalidate', 'class' => 'form-control'],
                'constraints' => [
                    new NotBlank(['message' => 'Le type de maladie ne peut pas être vide.']),
                ],
            ])
            ->add('dateCreation', DateType::class, [
                'label' => 'Date de Création',
                'widget' => 'single_text',
                'data' => new \DateTime(),
                'attr' => ['novalidate' => 'novalidate', 'class' => 'form-control'],
                'constraints' => [
                    new NotBlank(['message' => 'La date de création est requise.']),
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => ['novalidate' => 'novalidate', 'class' => 'form-control', 'rows' => 3],
                'constraints' => [
                    new NotBlank(['message' => 'La description ne peut pas être vide.']),
                ],
            ])
            ->add('dernierSuivi', DateType::class, [
                'label' => 'Dernier Suivi',
                'data' => new \DateTime(),
                'widget' => 'single_text',
                'attr' => ['novalidate' => 'novalidate', 'class' => 'form-control'],
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez indiquer la date du dernier suivi.']),
                ],
            ])
            ->add('id_user', EntityType::class, [
                'label' => 'Utilisateur',
                'class' => User::class,
                'choice_label' => 'id',
                'attr' => ['novalidate' => 'novalidate', 'class' => 'form-control'],
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez sélectionner un utilisateur.']),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DossierMedical::class,
        ]);
    }
}
