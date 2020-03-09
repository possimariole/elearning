<?php

namespace App\Form;

use App\Entity\Inscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('somme')
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                // prevents rendering it as type="date", to avoid HTML5 date pickers
                'html5' => true,
                // adds a class that can be selected in JavaScript
                'attr' => ['class' => 'datepicker'],
            ])
            ->add('anneeAcademique')
            ->add('niveau')
            ->add('specialite')
            ->add('apprenant', ApprenantType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Inscription::class,
        ]);
    }
}
