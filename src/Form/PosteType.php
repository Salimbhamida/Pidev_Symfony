<?php

namespace App\Form;

use App\Entity\Demande;
use App\Entity\Poste;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PosteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('experience',null,['attr'=>['empty_data'=>'']])
            ->add('description',null,['attr'=>['empty_data'=>'']])
            ->add('idCandidat', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',              
              ])
            /* ->add('idDemande', EntityType::class, [
                'class' => Demande::class,
                'choice_label' => 'idDemande',
              ]) */
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Poste::class,
        ]);
    }
}
