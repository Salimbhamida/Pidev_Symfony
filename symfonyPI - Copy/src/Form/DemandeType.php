<?php

namespace App\Form;

use App\Entity\Demande;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomRecruteur',null,['attr'=>['empty_data'=>'']])
            ->add('description',null,['attr'=>['empty_data'=>'']])
            ->add('experience',null,['attr'=>['empty_data'=>'']])
            ->add('remuneration',null,['attr'=>['empty_data'=>'']])
            ->add('telephone',null,['attr'=>['empty_data'=>'']])
            ->add('expiration',null,['attr'=>['empty_data'=>'']])
            ->add('idRecruteur', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
                
              ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Demande::class,
        ]);
    }
}
