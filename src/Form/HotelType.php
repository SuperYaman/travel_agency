<?php

namespace App\Form;

use App\Entity\Hotel;
use App\Entity\Villes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class HotelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if($options['ajouter'])
        {
        $builder
            ->add('name')
            ->add('description')
            ->add('adress')
            ->add('ville', EntityType::class, [
                "class"=>Villes::class,
                "choice_label"=>"name",
                "multiple"=>false,
                "attr"=>[
                    "class"=>"select2"
                ]

            ])


            ->add('prix', MoneyType::class)   
            ->add('prix_enfant', MoneyType::class)   

            ->add('image', FileType::class, [
                "required" => false
            ])
            ->add('image1', FileType::class, [
                "required" => false
            ])
            ->add('image2', FileType::class, [
                "required" => false
            ])

        ;
        }

        elseif($options['modifier'])
        {
            $builder
            ->add('name')
            ->add('description')
            ->add('adress')



            ->add('prix', MoneyType::class)   
            ->add('prix_enfant', MoneyType::class)   

            ->add('imageModif', FileType::class, [
                "required" => false
            ])
            ->add('image1Modif', FileType::class, [
                "required" => false
            ])
            ->add('image2Modif', FileType::class, [
                "required" => false
            ]) 
        ;

        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Hotel::class,
            'ajouter' => false,
            'modifier' => false
        ]);
    }
}
