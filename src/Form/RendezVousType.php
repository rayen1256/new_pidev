<?php

namespace App\Form;

use App\Entity\RendezVous;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RendezVousType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('NomPatient', TextType::class, [
                'label' => 'Nom du patient',
            ])




            ->add('NomMedecin', TextType::class, [
                'label' => 'Nom du médecin',
                'attr' => ['class' => 'form-control'],
            ])



            ->add('Date', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date du rendez-vous',
                
            ])
         // ->add('Heure', null, [
            //  'widget' => 'single_text',
           // ])
          //  ->add('Statut')




            ->add('Description', TextareaType::class, [
                'label' => 'Description',
            ])




            ->add('reservez',SubmitType::class, [
                'label' => 'Réserver',
                'attr' => [
                    'class' => 'btn btn-primary', // Ajoute la classe pour le style
                    'id' => 'submitId', // Ajoute l'ID spécifique
                    'name' => 'submit', // Ajoute le nom pour le bouton
            ]])



        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RendezVous::class,
        ]);
    }
}
