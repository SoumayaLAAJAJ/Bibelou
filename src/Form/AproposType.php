<?php

namespace App\Form;

use App\Entity\Apropos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class AproposType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, ['label'=>'Titre'] )
            ->remove('imageName')
            ->add('imageFile', FileType::class, ['label'=>'Image'])
            // ->add('updatedAt', DateTimeType::class, ['widget'=>'single_text', 'label'=>'Mis à jour le' ])
            ->add('description')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Apropos::class,
        ]);
    }
}
