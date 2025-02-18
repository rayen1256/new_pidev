<?php
// src/Form/DocumentMedicalType.php

namespace App\Form;

use App\Entity\DocumentMedical;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\NotBlank;

class DocumentMedicalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', TextType::class, [
                'label' => 'Type',
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new NotBlank(['message' => 'Le type est requis.']),
                ],
            ])
            ->add('titre', TextType::class, [
                'label' => 'Titre',
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new NotBlank(['message' => 'Le titre est requis.']),
                ],
            ])
            ->add('dateUpload', DateType::class, [
                'label' => 'Date d\'Upload',
                'widget' => 'single_text',
                'data' => new \DateTime(),
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new NotBlank(['message' => 'La date d\'upload est requise.']),
                ],
            ])
            ->add('fichier', FileType::class, [
                'label' => 'Fichier',
                'mapped' => false,  // Ne mappe pas directement le champ dans l'entité
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DocumentMedical::class,
        ]);
    }
}
