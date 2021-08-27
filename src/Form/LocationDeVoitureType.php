<?php

namespace App\Form;

use App\Entity\Villes;
use DateTime;

use App\Entity\LocationDeVoitures;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class LocationDeVoituresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($options['ajouter']) {
            $builder
                ->add('prix', MoneyType::class, [
                    "currency" => "EUR"
                ])
                ->add('modele', TextType::class)
                ->add('villeDepart',EntityType::class, [
                    "class"=>Villes::class,
                    "choice_label"=>"name",
                ])
                ->add('villeArrivee',EntityType::class, [
                    "class"=>Villes::class,
                    "choice_label"=>"name",
                ])
                ->add('date', DateType::class)
                ->add('dateRetour', DateType::class)
                ->add('image', FileType::class)
                ->add('image1', FileType::class)
                ->add('image2', FileType::class)
                ->add('Valider', SubmitType::class)
            ;
        }
        elseif($options['modifier']) {
            $builder
                ->add('prix', MoneyType::class, [
                    "currency" => "EUR"
                ])
                ->add('modele', TextType::class)
                ->add('villeDepart',EntityType::class, [
                    "class"=>Villes::class,
                    "choice_label"=>"name",
                ])
                ->add('villeArrivee',EntityType::class, [
                    "class"=>Villes::class,
                    "choice_label"=>"name",
                ])
                ->add('date', DateType::class)
                ->add('dateRetour', DateType::class)
                ->add('imageModif', FileType::class, [
                    "mapped" => false
                ])
                ->add('imageModif1', FileType::class)
                ->add('imageModif2', FileType::class)
                ->add('Valider', SubmitType::class)
            ;
        }
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LocationDeVoitures::class,
            'ajouter' => false,
            'modifier' => false
        ]);
    }
}
