<?php

namespace App\Form;

use App\Entity\ActivitePhysique;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;



class ActivitePhysiqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => ['novalidate' => 'novalidate'],
                'empty_data' => '',
                'constraints' => [
                    new NotBlank(['message' => 'S\'il vous plaît, entrez un nom']),
                ],
            ])
            ->add('duree', IntegerType::class, [
                'attr' => ['novalidate' => 'novalidate'],
                'constraints' => [
                    new NotBlank(['message' => 'S\'il vous plaît, entrez un nom']),
                ],
            ])
            ->add('type', ChoiceType::class, [
                'attr' => ['novalidate' => 'novalidate'], 'constraints' => [
                    new NotBlank(['message' => 'S\'il vous plaît, entrez un nom']),
                ],
                'choices' => [
                    'Cardio' => 'cardio',
                    'Renforcement musculaire' => 'musculation',
                    'Yoga' => 'yoga',
                    
                ],
            ])
            ->add('description', TextType::class, [
                'attr' => ['novalidate' => 'novalidate'],
                'empty_data' => 'Aucune description disponible',
                'constraints' => [
                    new NotBlank(['message' => 'La description ne peut pas être vide']),
                ],
            ])
            ->add('intensite', ChoiceType::class, [
                'choices' => [
                    'Faible' => 'faible',
                    'Moyenne' => 'moyenne',
                    'Élevée' => 'elevee',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ActivitePhysique::class,
        ]);
    }
}
