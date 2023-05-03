<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Services;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoriesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomCategorie')
            
            ->add('nbTotService' ,null, ['attr'=> ['empty_data'=>'']])
            ->add('idService',null, ['attr'=> ['empty_data'=>'']])
            ->add('idService', EntityType::class, [
                'class' => Services::class,
                'choice_label' => 'idService',
                'expanded' => false
              ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Categories::class,
        ]);
    }
}
