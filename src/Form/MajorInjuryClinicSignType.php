<?php

namespace App\Form;

use App\Entity\ClinicSignType;
use App\Entity\ClinicSignValue;
use App\Entity\MajorInjuryClinicSign;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MajorInjuryClinicSignType extends AbstractType
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
            ->add('expectedValue', EntityType::class, [
                'class' => ClinicSignValue::class,
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false,
                'required' => true,
                'label' => 'Valeur attendue',
                'autocomplete' => 'true'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MajorInjuryClinicSign::class,
        ]);
    }
}
