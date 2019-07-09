<?php

namespace App\Form;

use App\Entity\Location;
use App\Form\LocationType;
use App\Entity\Locataire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateLocation')
            ->add('typeLocation')
            ->add('montantLocation')
            ->add('caution')
            ->add('etatLocation')
            ->add('locataire', EntityType::class, array(
                        'class'=>'App\Entity\Locataire',
                        'choice_label'=>'prenomLocataire',
                        'choice_label'=>'nomLocataire',
                        'expanded'=>false,
                        'multiple'=>false))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}
