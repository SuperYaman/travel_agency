<?php

namespace App\Form;

use App\Entity\Pays;
use App\Entity\Villes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VillesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('pays', EntityType::class, [
                "class"=>Pays::class,
                "choice_label"=>"name",
                "multiple"=>false,
                "attr"=>[
                    "class"=>"select2"
                ]

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Villes::class,
        ]);
    }
}
