<?php

namespace App\Form;

use App\Entity\Demande;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('nomRecruteur', null, ['attr' => ['empty_data' => '']])
      ->add('description', null, ['attr' => ['empty_data' => '']])
      ->add('experience', null, ['attr' => ['empty_data' => '']])
      ->add('remuneration', null, ['attr' => ['empty_data' => '']])
      ->add('telephone', null, ['attr' => ['empty_data' => '']])
      ->add('expiration', null, ['attr' => ['empty_data' => '']])
      ->add('idRecruteur', EntityType::class, [
        // looks for choices from this entity
        'class' => User::class,

        // uses the User.username property as the visible option string
        'choice_label' => 'id',
        'mapped' => false,


        // used to render a select box, check boxes or radios
        // 'multiple' => true,
        // 'expanded' => true,
      ]);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => Demande::class,
    ]);
  }
}
