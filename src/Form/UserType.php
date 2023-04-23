<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('username', null, [
        'attr' => ['class' => 'form-control', 'placeholder' => 'Username', 'empty_data' => '']
      ])
      ->add('email', null, [
        'attr' => ['class' => 'form-control', 'placeholder' => 'Email', 'empty_data' => '']
      ])
      ->add('password', PasswordType::class, [
        'attr' => ['class' => 'form-control', 'placeholder' => 'Password', 'empty_data' => '']
      ])
      ->add('role', ChoiceType::class, [
        'attr' => ['class' => 'form-select form-select-lg mb-3'],
        'choices'  => [
          'Freelancer' => 'freelancer',
          'Candidat' => 'candidat',
          'Recruteur' => 'recruteur',
        ],

      ],)
      ->add('roles', ChoiceType::class, [
        'attr' => ['class' => 'form-select form-select-lg mb-3'],
        'choices'  => [
          'Utilisateur' => 'ROLE_USER',
          'Administrateur' => 'ROLE_ADMIN',
        ],
        'expanded' => true,
        'multiple' => true,
        'label' => 'Roles',

      ],);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => User::class,
    ]);
  }
}
