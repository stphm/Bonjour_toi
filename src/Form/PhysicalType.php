<?php

namespace App\Form;

use App\Entity\Physical;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class PhysicalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('birthday', BirthdayType::class, [
            'label' => 'Birthday'
        ])
            ->add('gender', ChoiceType::class, [
            'label' => 'sexe',
            'choices'  => [
                'Women' => true,
                'Men' => false,
            ],
        ])
            ->add('height', NumberType::class, [
            'label' => 'Height'
        ])
            ->add('hair_color', TextType::class, [
                'label' => 'Hair color'
            ])
            ->add('eyes_color', TextType::class, [
                'label' => 'Eyes color'
            ])
            ->add('weight', NumberType::class, [
                'label' => 'Weight'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Physical::class,
        ]);
    }
}
