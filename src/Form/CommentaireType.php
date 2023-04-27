<?php

namespace App\Form;

use App\Entity\Commentaire;
use App\Entity\Reclamation;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class CommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           
        ->add('description_c', TextareaType::class, [
            'label' => 'Description',
            'constraints' => [
                new NotBlank([
                    'message' => 'Champs Description est obligatoire'
                ]   )
            ],

            'attr' => [
                'class' => 'form-control',
                'rows' => 5,
            ],
        ])
        //     ->add('reclamation',EntityType::class,[
        //         'class'=>Reclamation::class,
        //         'choice_label'=>'Id',
        //         'multiple'=>false,
        //         'expanded'=>false,
        //     ])
         ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commentaire::class,
        ]);
    }
}
