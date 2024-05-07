<?php

namespace App\Form;

use App\Data\SearchData;
use App\Entity\Physical;
use Closure;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType  extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('q', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Rechercher'
                ]
            ])
            ->add('sexe', ChoiceType::class, [
                'label' => "sexe ",
                'choices' => [
                    'Homme'=>false,
                    'Femme'=> true                   
                ],
                'placeholder' => "--Choisir votre sexe",
                'required'=>false
            ])
            ->add('min', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Age min'
                ]
            ]) 
            ->add('max', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Age max'
                ]
            ]) 

            
            ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data-class' => SearchData::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);

    }

    public function getBlockPrefix()
    {
        return '';
    }
}