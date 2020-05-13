<?php

namespace App\Form;

use App\Form\DiplomeType;
use App\Entity\Enseignant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class EnseignantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('dateNaiss', DateType::class, [
                'widget' => 'single_text',
                // prevents rendering it as type="date", to avoid HTML5 date pickers
                'html5' => true,
                // adds a class that can be selected in JavaScript
                'attr' => ['class' => 'datepicker'],
            ])
            ->add('pays')
            ->add('ville')
            ->add('sexe')
            ->add('lieuNaissance') 
            ->add('adresse', AdresseType::class)
            ->add('diplomes', CollectionType::class, [
                'entry_type' => DiplomeType::class,
                'entry_options' => [
                    'label' => false
                ],
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Enseignant::class,
        ]);
    }
}
