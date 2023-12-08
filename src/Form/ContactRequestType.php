<?php

namespace App\Form;

use App\Entity\ContactRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'required' => true,
                'label' => 'Prénom',
            ])
            ->add('lastname', TextType::class, [
                'required' => true,
                'label' => 'Nom',
            ])
            ->add('email', TextType::class, [
                'required' => true,
                'label' => 'Email',
            ])
            ->add('reason', ChoiceType::class, [
                'label' => 'Raison',
                'choices'  => [
                    '' => null,
                    'Remarque' => 'feedbacks',
                    'Bugs trouvés' => 'bugs',
                    'Demande de contact' => 'contact',
                    'Autre' => 'other',
                    ]
                ])
            ->add('message', TextareaType::class, [
                'required' => true,
                'label' => 'Message',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactRequest::class,
        ]);
    }
}
