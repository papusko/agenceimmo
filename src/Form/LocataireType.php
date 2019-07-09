<?php

namespace App\Form;

use App\Entity\Locataire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocataireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomLocataire')
            ->add('prenomLocataire')
            ->add('nationalite')
            ->add('telephone')
            ->add('piecesFournis')
            ->add('typeLocataire')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Locataire::class,
        ]);
    }
}
