<?php

namespace App\Form;

use App\Entity\Scolarite;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class ScolariteType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomEtablissement')
            ->add('ville')
            ->add('pays', TextType::class, [
                'attr' => [
                    'class' => '.js_pays',
                    'data-remote' => '/pays-suggestions'
                ]])
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
