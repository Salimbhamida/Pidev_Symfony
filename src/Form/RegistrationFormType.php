<?php

namespace App\Form;

use App\Entity\User;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;
use MeteoConcept\HCaptchaBundle\Form\HCaptchaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('username', null, [
        'attr' => ['placeholder' => 'Username']
      ])
      ->add('email', null, [
        'attr' => ['placeholder' => 'Email']
      ])

      ->add('plainPassword', RepeatedType::class, [
        // instead of being set onto the object directly,
        // this is read and encoded in the controller
        'type' => PasswordType::class,
        'invalid_message' => 'The password fields must match.',
        'options' => ['attr' => ['class' => 'password-field']],
        'required' => true,
        'first_options'  => ['label' => 'Password'],
        'second_options' => ['label' => 'Repeat Password'],
        'mapped' => false,
        'attr' => ['autocomplete' => 'new-password'],
        'constraints' => [
          new NotBlank([
            'message' => 'Please enter a password',
          ]),
          new Length([
            'min' => 6,
            'minMessage' => 'Your password should be at least {{ limit }} characters',
            // max length allowed by Symfony for security reasons
            'max' => 4096,
          ]),
        ],
      ])
      ->add('role', ChoiceType::class, [
        'attr' => ['class' => 'form-select form-select'],
        'choices'  => [
          'Freelancer' => 'freelancer',
          'Candidat' => 'candidat',
          'Recruteur' => 'recruteur',
        ],
      ],)
      ->add('captcha', HCaptchaType::class, [
        'label' => 'Anti-bot test',
        // optionally: use a different site key than the default one:
        'hcaptcha_site_key' => '42fa8dfd-29ee-43d1-8b0e-eecee058ea44',
      ]);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => User::class,
    ]);
  }
}
