<?php

namespace App\Form;

use App\Entity\OriginalCar;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OriginalCarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('brand')
            ->add('model')
            ->add('performance')
            ->add('manufacturedFrom', null, [
                'widget' => 'single_text',
            ])
            ->add('manufacturedTo', null, [
                'widget' => 'single_text',
            ])
            ->add('image')
            ->add('createdAt', null, [
                'widget' => 'single_text',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => OriginalCar::class,
        ]);
    }
}
