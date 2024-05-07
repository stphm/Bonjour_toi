<?php

namespace App\Form;

use App\Entity\Personnality;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PersonnalityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('music', TextType::class, [
            'label' => 'Favorite music', 
            'attr' => [
                'placeholder' => 'Favorite Music, Kind of Music'
            ]
        ])
            ->add('movie', TextType::class, [
            'label' => 'Favorite Movie',
            'attr' => [
                'placeholder' => 'Favorite Movie, Kind of Movie'
            ]
        ])
            ->add('book', TextType::class, [
            'label' => 'Favorite Book',
            'attr' => [
                'placeholder' => 'Favorite Book, Kind of Book'
            ]
        ])
        ->add('favorite_activity', TextType::class, [
            'label' => 'Favorite Activity',
            'attr' => [
                'placeholder' => 'Favorite Activity, Kind of Activity'
            ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Personnality::class,
        ]);
    }
}
