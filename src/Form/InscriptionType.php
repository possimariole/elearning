<?php

namespace App\Form;

use App\Entity\Inscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('somme')
            ->add('date')
            ->add('anneeAcademique')
            ->add('niveau')
            ->add('apprenant')
            ->add('specialite')
            ->add('Specialite', SpecialiteType::class)
            ->add('Apprenant', ApprenantType::class)
            ->add('AnneeAcademique', AnneeAcademiqueType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Inscription::class,
        ]);
    }
}
