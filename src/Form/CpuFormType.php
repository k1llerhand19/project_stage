<?php

namespace App\Form;

use App\Entity\Cpu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CpuFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('marque')
            ->add('modele')
            ->add('supportcpu')
            ->add('frequencecpu')
            ->add('nbrcore')
            ->add('nbrthreads')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cpu::class,
        ]);
    }
}
