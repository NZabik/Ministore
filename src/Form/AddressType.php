<?php
// src/Form/AddressType.php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('adresse', TextType::class, [
            'empty_data' => 'Adresse par défaut',
            'attr' => [
                'class' => 'form-control',
                'minlenght' => 2,
                'maxlenght' => 255
            ],
            'label' => 'Address',
            'label_attr' => [
                'class' => 'form-label mt-2',
            ],
            'constraints' => [
                new Assert\Length(['min' => 2, 'max' => 255]),
                new Assert\NotBlank,
            ]
        ])
        ->add('codePostal', IntegerType::class, [
            'attr' => [
                'class' => 'form-control',
                'minlenght' => 2,
                'maxlenght' => 5
            ],
            'label' => 'ZIP code',
            'label_attr' => [
                'class' => 'form-label mt-2',
            ],
            'constraints' => [
                new Assert\Length(['min' => 2, 'max' => 5]),
                new Assert\NotNull,
            ]
        ])
        ->add('ville', TextType::class, [
            'attr' => [
                'class' => 'form-control',
                'minlenght' => 2,
                'maxlenght' => 255
            ],
            'label' => 'Town',
            'label_attr' => [
                'class' => 'form-label mt-2',
            ],
            'constraints' => [
                new Assert\Length(['min' => 2, 'max' => 255]),
                new Assert\NotBlank,
            ]
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configurez vos options ici
        ]);
    }
}
?>