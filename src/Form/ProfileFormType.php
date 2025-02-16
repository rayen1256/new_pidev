<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;  // 
use Symfony\Component\Form\Extension\Core\Type\IntegerType; // 
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;  // 
use Symfony\Component\Form\Extension\Core\Type\DateType; 
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\Extension\Core\Type\FileType; // 
    // 


class ProfileFormType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $this->security->getUser();
        $builder
        ->add('username', TextType::class, [
            'label' => 'Nom d\'utilisateur',
            'attr' => ['placeholder' => 'Entrez votre nom d\'utilisateur']
        ])
        ->add('telephone', TextType::class, [
            'label' => 'Téléphone',
            'required' => false,
            'attr' => ['placeholder' => 'Entrez votre numéro de téléphone']
        ])
        ->add('age', IntegerType::class, [
            'label' => 'Âge',
            'required' => false,
            'attr' => ['placeholder' => 'Entrez votre âge']
        ])
        ->add('description', TextType::class, [
            'label' => 'Description',
            'required' => false,
            'attr' => ['placeholder' => 'Décrivez-vous en quelques mots']
        ])
        ->add('etat', ChoiceType::class, [
            'label' => 'État',
            'choices' => [
                'Actif' => 'actif',
                'Inactif' => 'inactif',
            ],
            'required' => false,
        ])
        ->add('dateNaissance', DateType::class, [
            'label' => 'Date de naissance',
            'widget' => 'single_text',
            'required' => false,
        ])
        ->add('status', ChoiceType::class, [
            'label' => 'Statut',
            'choices' => [
                'Célibataire' => 'celibataire',
                'Marié' => 'marie',
                'Divorcé' => 'divorce',
                'Veuf/Veuve' => 'veuf',
            ],
            'required' => false,
        ])
        ->add('latitude', TextType::class, [
            'label' => 'Latitude',
            'required' => false,
            'attr' => ['placeholder' => 'Entrez votre latitude']
        ])
        ->add('longitude', TextType::class, [
            'label' => 'Longitude',
            'required' => false,
            'attr' => ['placeholder' => 'Entrez votre longitude']
        ])
        ->add('profilePicture', FileType::class, [
            'label' => 'Photo de profil', // Le label pour le champ de fichier
            'required' => false, // Le champ n'est pas obligatoire
            'mapped' => false, // Cela signifie qu'il ne sera pas mappé directement sur l'entité User
            'attr' => ['accept' => 'image/*'], // Pour limiter les types de fichiers acceptés (ici les images)
        ]);
        if ($user instanceof User && in_array('ROLE_MEDECIN', $user->getRoles(), true)) {
            $builder
                ->add('specialite', TextType::class, [
                    'label' => 'Spécialité',
                    'required' => false,
                    'attr' => ['placeholder' => 'Entrez votre spécialité médicale']
                ])
                ->add('diplome', TextType::class, [
                    'label' => 'Diplôme',
                    'required' => false,
                    'attr' => ['placeholder' => 'Entrez votre diplôme']
                ])
                ->add('experience', IntegerType::class, [
                    'label' => 'Années d\'expérience',
                    'required' => false,
                    'attr' => ['placeholder' => 'Nombre d\'années d\'expérience']
                ])
                ->add('adresseCabinet', TextType::class, [
                    'label' => 'Adresse du cabinet',
                    'required' => false,
                    'attr' => ['placeholder' => 'Adresse de votre cabinet médical']
                ])
                ->add('horaireConsultation', TextType::class, [
                    'label' => 'Horaires de consultation',
                    'required' => false,
                    'attr' => ['placeholder' => 'Ex: Lundi-Vendredi 9h-18h']
                ])
                ->add('numeroProfessionnel', TextType::class, [
                    'label' => 'Numéro professionnel',
                    'required' => false,
                    'attr' => ['placeholder' => 'Entrez votre numéro professionnel']
                ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
