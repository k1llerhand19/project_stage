<?php

namespace App\Form;

use App\Entity\Gpu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GpuFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('marque')
            ->add('modele')
            ->add('chipsetgraphique')
            ->add('taillememoire')
            ->add('typememoire')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Gpu::class,
        ]);
    }
}
