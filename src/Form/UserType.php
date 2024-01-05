<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => 2,
                    'maxlenght' => 50
                ],
                'label' => 'Last name',
                'label_attr' => [
                    'class' => 'form-label mt-2',
                ],
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank,
                ]
            ])
            ->add('prenom', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => 2,
                    'maxlenght' => 50
                ],
                'label' => 'First name',
                'label_attr' => [
                    'class' => 'form-label mt-2',
                ],
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank,
                ]
            ])
            ->add('plainPassword', PasswordType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Actual password',
                'label_attr' => ['class' => 'form-label mt-2'],
                'constraints' => [new Assert\NotBlank]
                ]
            )
            ->add('newPassword', RepeatedType::class,[
                'type'=>PasswordType::class,
                'first_options'=>[
                    'attr' => ['class' => 'form-control'],
                    'label'=>'New password',
                    'label_attr' => ['class' => 'form-label mt-2'],
                ],
                'second_options'=>[
                    'attr' => ['class' => 'form-control'],
                    'label'=>'New password confirmation',
                    'label_attr' => ['class' => 'form-label mt-2'],
                ],
                'invalid_message'=>'The passwords does not match'
            ])
            ->add('adresse', TextType::class, [
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

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
