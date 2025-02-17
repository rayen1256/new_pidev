<?php

namespace App\Form;

use App\Entity\CategorieEvent;
use App\Entity\Event;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Titre')
            ->add('Description')
            ->add('Date', null, [
                'widget' => 'single_text',
            ])
            ->add('Heure', null, [
                'widget' => 'single_text',
            ])
            ->add('Localisation')
            ->add('CategorieEvent', EntityType::class, [
                'class' => CategorieEvent::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
