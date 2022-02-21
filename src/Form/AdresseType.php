<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TelType;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label'=>'Nom de votre adresse *', 
                'attr'=> [

                    'placeholder'=>'Maison, Bureau...'
                ]
                ])
            ->add('lastname', TextType::class, ['label'=>'Nom et Prénom *'])
            ->add('company', TextType::class, ['label'=>'Nom de votre entreprise', "required"=> false, 
            'attr'=> [

                'placeholder'=>'Facultatif'
            ]] )
            ->add('address', TextType::class, ['label'=>'Adresse *'])
            ->add('zipcode', TextType::class, ['label'=>'Code Postal *'])
            ->add('city', TextType::class, ['label'=>'Ville *'])
            ->add('country', CountryType::class, ['label'=>'Pays *'])
            ->add('phone', TelType::class, ['label'=>'Numéro de téléphone *'])
            ->add('submit', SubmitType::class, ['label'=>'Sauvegarder'])
            ->remove('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
