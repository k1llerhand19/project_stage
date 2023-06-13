<?php

namespace App\Form;

use App\Entity\Cartemere;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CartemereFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('marque')
            ->add('modele')
            ->add('supportcpu')
            ->add('nbrcpusupporte')
            ->add('chipset')
            ->add('typememoire')
            ->add('capacitemaximalramparslot')
            ->add('capacitemaximalram')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cartemere::class,
        ]);
    }
}
