<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Orders;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class OrderValidationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
//         $builder
//             ->add('reference')
//             ->add('createdAt')
//             ->add('adresse')
//             ->add('code_postal')
//             ->add('ville')
//             ->add('user', EntityType::class, [
//                 'class' => User::class,
// 'choice_label' => 'id',
//             ])
//         ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Orders::class,
        ]);
    }
}
