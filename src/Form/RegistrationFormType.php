<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
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
                'label' => 'Nom',
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
                'label' => 'Prénom',
                'label_attr' => [
                    'class' => 'form-label mt-2',
                ],
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank,
                ]
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => 2,
                    'maxlenght' => 180
                ],
                'label' => 'Adresse email',
                'label_attr' => [
                    'class' => 'form-label mt-2',
                ],
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 180]),
                    new Assert\NotBlank,
                    new Assert\Email,
                ]
            ])
            ->add('adresse', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => 2,
                    'maxlenght' => 255
                ],
                'label' => 'Adresse',
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
                'label' => 'Code postal',
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
                'label' => 'Ville',
                'label_attr' => [
                    'class' => 'form-label mt-2',
                ],
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 255]),
                    new Assert\NotBlank,
                ]
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'attr' => [
                        'class' => 'form-control',
                    ],
                    'label' => 'Mot de passe',
                    'label_attr' => [
                        'class' => 'form-label mt-2',
                    ],
                ],
                'second_options' => [
                    'attr' => [
                        'class' => 'form-control',
                    ],
                    'label' => 'Confirmation du mot de passe',
                    'label_attr' => [
                        'class' => 'form-label mt-2',
                    ],
                ],
                'invalid_message' => 'les mots de passe ne correspondent pas'
            ])

            ->add('RGPD', CheckboxType::class, [
                'label' => "termes d'utilisation du site",
                'label_attr' => [
                    'class' => 'form-label mt-2',
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
