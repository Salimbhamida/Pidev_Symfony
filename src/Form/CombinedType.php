<?php

namespace App\Form;

use App\Entity\Experiences;
use App\Entity\Competences;
use App\Entity\Scolarite;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual; 
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CombinedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('poste', TextType::class, [
            'constraints' => [
                new NotBlank([
                    'message' => 'Le champ poste ne doit pas être vide.',
                ]),
                new Length([
                    'min' => 2,
                    'max' => 50,
                    'minMessage' => 'Le champ poste doit contenir au moins {{ limit }} caractères.',
                    'maxMessage' => 'Le champ poste ne peut pas contenir plus de {{ limit }} caractères.',
                ]),
            ],
        ])
        ->add('nomEntreprise', TextType::class, [
            'constraints' => [
                new NotBlank([
                    'message' => 'Le champ nomEntreprise ne doit pas être vide.',
                ]),
                new Length([
                    'min' => 2,
                    'max' => 50,
                    'minMessage' => 'Le champ nomEntreprise doit contenir au moins {{ limit }} caractères.',
                    'maxMessage' => 'Le champ nomEntreprise ne peut pas contenir plus de {{ limit }} caractères.',
                ]),
            ],
        ])
        ->add('dateDebut', DateType::class, [
            'widget' => 'single_text',
            'html5' => false,
            'format' => 'dd/MM/yyyy',
            'constraints' => [
                new NotBlank([
                    'message' => 'Le champ dateDebut ne doit pas être vide.',
                ]),
                new Date([
                    'message' => 'Le champ dateDebut doit être une date valide.',
                ]),
            ],
        ])
        ->add('dateFin', DateType::class, [
            'widget' => 'single_text',
            'html5' => false,
            'format' => 'dd/MM/yyyy',
            'constraints' => [
                new NotBlank([
                    'message' => 'Le champ dateFin ne doit pas être vide.',
                ]),
                new Date([
                    'message' => 'Le champ dateFin doit être une date valide.',
                ]),
                new GreaterThanOrEqual([
                    'value' => 'today',
                    'message' => 'Le champ dateFin doit être supérieure ou égale à la date du jour.',
                ]),
            ],
        ])
        ->add('nom', TextType::class, [
            'constraints' => [
                new NotBlank([
                    'message' => 'Le champ nom ne doit pas être vide.',
                ]),
                new Length([
                    'min' => 2,
                    'max' => 50,
                    'minMessage' => 'Le champ nom doit contenir au moins {{ limit }} caractères.',
                    'maxMessage' => 'Le champ nom ne peut pas contenir plus de {{ limit }} caractères.',
                ]),
            ],
        ])
        ->add('nomEtablissement', TextType::class, [
            'constraints' => [
                new NotBlank([
                    'message' => 'Le champ nomEtablissement ne doit pas être vide.',
                ]),
                new Length([
                    'min' => 2,
                    'max' => 50,
                    'minMessage' => 'Le champ nomEtablissement doit contenir au moins {{ limit }} caractères.',
                    'maxMessage' => 'Le champ nomEtablissement ne peut pas contenir plus de {{ limit }} caractères.',
                ]),
            ],
        ])
        ->add('ville', TextType::class, [
            'constraints' => [
                // Ajouter des contraintes pour le champ ville
            ]
        ])
        ->add('pays', TextType::class, [
            'constraints' => [
                // Ajouter des contraintes pour le champ pays
            ]
        ])
        ->add('diplome', TextType::class, [
            'constraints' => [
                // Ajouter des contraintes pour le champ diplome
            ]
        ])
        ->add('dateObtention', DateType::class, [
            // Ajouter des options pour le champ dateObtention
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
            
        ]);
    }
}
