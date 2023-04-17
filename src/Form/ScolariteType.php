<?php

namespace App\Form;

use App\Entity\Scolarite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ScolariteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomEtablissement')
            ->add('ville')
            ->add('pays')
            ->add('diplome')
            ->add('dateObtention')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Scolarite::class,
        ]);
    }
}
