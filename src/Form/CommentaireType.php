<?php

namespace App\Form;

use App\Entity\Commentaire;
use App\Entity\Reclamation;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_c')
            ->add('description_c')
            ->add('reclamation',EntityType::class,[
                'class'=>Reclamation::class,
                'choice_label'=>'Id',
                'multiple'=>false,
                'expanded'=>false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commentaire::class,
        ]);
    }
}
