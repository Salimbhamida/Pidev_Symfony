<?php

namespace App\Form;

use App\Entity\Competences;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Repository\CompetenceRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompetencesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class, [
            'attr' => [
                'class' => '.select2',
                'data-route' => 'assets/skills.json',
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Competences::class,
        ]);
    }
}
