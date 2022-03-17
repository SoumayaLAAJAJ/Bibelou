<?php

namespace App\Form;

use App\Entity\SecondCarousel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SecondCarouselType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, ['label'=>'Titre'])
            ->remove('texte')
            ->remove('imageName')
            ->add('imageFile', FileType::class, ['label'=>'Image', "required"=>false])
            ->remove('updatedAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SecondCarousel::class,
        ]);
    }
}
