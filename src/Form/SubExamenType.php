<?php

namespace App\Form;

use App\Entity\ClinicExamen;
use App\Entity\ClinicSignType;
use App\Entity\ClinicSignValue;
use App\Entity\MajorInjuryClinicSign;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubExamenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', EntityType::class, [
                'class' => ClinicSignType::class,
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false,
                'required' => true,
                'label' => 'Type d\'examen',
                'autocomplete' => 'true'
            ])
            ->add('availableValues', EntityType::class, [
                'class' => ClinicSignValue::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
                'required' => true,
                'label' => 'Valeur attendue',
                'autocomplete' => 'true',
                'attr' => ['data-ea-widget' => 'ea-autocomplete']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ClinicExamen::class,
        ]);
    }
}
