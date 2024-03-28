<?php

namespace App\Form;

use App\Entity\BodyDesign;
use App\Entity\Chassis;
use App\Entity\Lighting;
use App\Entity\Manufacturer;
use App\Entity\ModelCar;
use App\Entity\OriginalCar;
use App\Entity\PowerConducter;
use App\Entity\Remarks;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModelCarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ulid')
            ->add('scale')
            ->add('manufacturedFrom', null, [
                'widget' => 'single_text',
            ])
            ->add('manufacturedTo', null, [
                'widget' => 'single_text',
            ])
            ->add('updatedAt', null, [
                'widget' => 'single_text',
            ])
            ->add('createdAt', null, [
                'widget' => 'single_text',
            ])
            ->add('originalCar', EntityType::class, [
                'class' => OriginalCar::class,
                'choice_label' => 'id',
            ])
            ->add('manufacturer', EntityType::class, [
                'class' => Manufacturer::class,
                'choice_label' => 'id',
            ])
            ->add('powerConducter', EntityType::class, [
                'class' => PowerConducter::class,
                'choice_label' => 'id',
            ])
            ->add('lighting', EntityType::class, [
                'class' => Lighting::class,
                'choice_label' => 'id',
            ])
            ->add('chassis', EntityType::class, [
                'class' => Chassis::class,
                'choice_label' => 'id',
            ])
            ->add('bodyDesign', EntityType::class, [
                'class' => BodyDesign::class,
                'choice_label' => 'id',
            ])
            ->add('remark', EntityType::class, [
                'class' => Remarks::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ModelCar::class,
        ]);
    }
}
