<?php

namespace App\Form;

use App\Entity\Article;
use App\Form\CodeColorType;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['label'=>'Nom'] )
            ->add('price', MoneyType::class,['label'=>'Prix'])
            ->add('description', CKEditorType::class )
            ->remove('imageName')
            ->add('imageFile', FileType::class, ['label'=>'Image', "required"=>false])
            ->remove('updatedAt')
            ->add('category', null, ['label'=>'Catégorie'])
            ->add("colors", CollectionType::class, ['label'=> false,'entry_type' => CodeColorType::class, "allow_add"=>true, "allow_delete"=>true, "by_reference"=>false ])
            ->add('photos', CollectionType::class, ['label'=>"Images supplémentaires", 'entry_type' => PhotoSuppType::class, "allow_add"=>true, "allow_delete"=>true, "by_reference"=>false] )
            ->add('size')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
