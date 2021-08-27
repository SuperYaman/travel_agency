<?php

namespace App\Form;



use App\Entity\Villes;
use App\Entity\Vol;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class VolType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numeroVol')
            ->add('nomCompagny', TextType::class,[
            "label" =>"Nom de la Compagnie Aerienne",
            "required" =>"false",
            "attr" => [
                "class" => "inputExemple"],
            ])
            ->add('dateDepart')
            ->add('dateArrivee')
            ->add('heureDepart')
            ->add('heureArrivee')
            ->add('prix', MoneyType::class, [
                "currency" => "EUR",
                // 'money_pattern' => 
                "label" => "Prix du billet",
                "required" => false,
                "attr" => [
                    "placeholder" => "saisir le prix",
                    "style" => "background-color:aqua"
                ]
            ])


            ->add('villeDepart',EntityType::class, [
                "class"=>Villes::class,
                "choice_label"=>"name",
            ])
            ->add('villeArrivee',EntityType::class, [
                "class"=>Villes::class,
                "choice_label"=>"name",
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vol::class,
        ]);
    }
}
