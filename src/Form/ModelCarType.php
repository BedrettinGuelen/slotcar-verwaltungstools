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
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModelCarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('manufacturer', EntityType::class, [
                'class' => Manufacturer::class,
                'query_builder' => function (EntityRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('ma')
                        ->orderBy('ma.manufacturer', 'ASC');
                },
                'choice_label' => 'manufacturer'
            ])
            ->add('scale', ChoiceType::class, [
                'label' => 'Scale  ',
                'choices' => [
                    '1:18' => '1:18',
                    '1:24' => '1:24',
                    '1:32' => '1:32',
                    '1:43' => '1:43',
                    '1:64' => '1:64'
                ]])
            ->add('originalCar', EntityType::class, [
                'class' => OriginalCar::class,
                'choice_label' => 'brand.brandName',
            ])
            ->add('powerConducter', EntityType::class, [
                'class' => PowerConducter::class,
                'choice_label' => 'powerConducter',
            ])
            ->add('lighting', EntityType::class, [
                'class' => Lighting::class,
                'choice_label' => 'lighting',
            ])
            ->add('chassis', EntityType::class, [
                'class' => Chassis::class,
                'choice_label' => 'chassis',
            ])
            ->add('bodyDesign', EntityType::class, [
                'class' => BodyDesign::class,
                'choice_label' => 'design',
            ])
            ->add('remark', EntityType::class, [
                'class' => Remarks::class,
                'choice_label' => 'remark',
            ])
            ->add('manufacturedFrom', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Manufactured to',
            ])
            ->add('manufacturedTo', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Manufactured to',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ModelCar::class,
        ]);
    }
}
