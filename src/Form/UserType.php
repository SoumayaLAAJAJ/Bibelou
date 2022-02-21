<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Address;
use App\Form\AdresseType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, ["label"=>"Email"])
            ->add('plainPassword', PasswordType::class, ["mapped"=>false, "required"=>false ,"label"=>"Nouveau mot de passe"])
            ->add('adresses', CollectionType::class, ['label'=> false,'entry_type' => AdresseType::class, "allow_add"=>true, "allow_delete"=>true, "by_reference"=>false ])
            ->remove('roles')
            ->remove('password')
            ->remove('firstname')
            ->remove('name')
            ->remove('isVerified')
            // ->add("Sauvegarder", SubmitType::class, ["attr"=>["class"=> "btn btn-danger"]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
