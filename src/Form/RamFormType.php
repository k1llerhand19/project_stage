<?php

namespace App\Form;

use App\Entity\Ram;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RamFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('marque')
            ->add('modele')
            ->add('typememoire')
            ->add('frequencememoire')
            ->add('capaciteparbarrette')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ram::class,
        ]);
    }
}
