<?php

namespace App\Form;

use App\Entity\Brand;
use App\Entity\OriginalCar;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class OriginalCarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('brand', EntityType::class, [
                'class' => Brand::class,
                'label' => "Marke",
                'query_builder' => function (EntityRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('b')
                        ->orderBy('b.brandName', 'ASC');
                },
                'choice_label' => 'brand_name'])
            ->add('model', TextType::class, [
                'label' => 'Typenbezeichnung',
            ]) 
            ->add('performancePS', NumberType::class, [
                'html5' => true,
                'label' => 'Leistung in PS',
            ])
            ->add('performanceKW', NumberType::class, [
                'html5' => true,
                'label' => 'Leistung in KW',
            ])
            ->add('manufacturedFrom', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Hergestellt von',
            ])
            ->add('manufacturedTo', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Hergestellt bis',
            ])
            ->add('image', FileType::class, [
                'label' => 'Car Image (JPEG, PNG, or GIF file)',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image (JPEG, PNG, or GIF)',
                    ])
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => OriginalCar::class,
        ]);
    }
}
