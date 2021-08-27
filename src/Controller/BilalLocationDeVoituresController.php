<?php

namespace App\Controller;

use App\Entity\LocationDeVoitures;
use App\Form\LocationDeVoituresType;
use App\Repository\LocationDeVoituresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BilalLocationDeVoituresController extends AbstractController
{
    /**
     * @Route("/LocationDeVoitures/ajouter", name="voiture_ajouter")
     */
    public function voiture_ajouter (Request $request, EntityManagerInterface $manager)
    {
      
        $Location = new LocationDeVoitures;

        

        $form = $this->createForm(LocationDeVoituresType::class, $Location); // ('ajouter' => true));
      

        $form->handleRequest($request); // traitement du formulaire

        // si le formulaire a été soumis (clic sur le bouton "Ajouter" : type="submit")
        // et si le formulaire est valide (contraintes : il respecte toutes les conditions : ex: prix, titre non vides)
        if ($form->isSubmitted() && $form->isValid()) {
            //dump($produit);

           

            // $imageFile = $form->get('image')->getData();
            


            //if ($imageFile) // si $imageFile n'est pas vide/null (une image a été upload/chargée)
            {
                // Traitement de l'image
                // 3 étapes

                // 1e étape : renommer le nom de l'image

                // $nomImage = date("YmdHis") . "-" . uniqid() . "-" . $imageFile->getClientOriginalName();
                //dd($nomImage);


                // 2e étape : Envoyer l'image dans le dossier public / images / imagesUpload

                // move() permet de déplacer le fichier
                // 2 arguments :
                // 1e : emplacement : getParameter()        // où déplacer l'image ???
                // 2e : le nom du fichier qu'on déplace      // sous quel nom ???

                //$imageFile->move(
                   // $this->getParameter("image_produit"),
                   // $nomImage
                // );

                /*
                    la méthode getParameter() renvoie sur le fichier config/services.yaml aux paramètres (ligne 6)
                    les paramètres définissent un emplacement
                    1 argument : le nom du paramètre
                */


                // 3e étape : envoyer le nom de l'image en bdd

                // $Location->setImage($nomImage);


            }// fermeture de la condition $imageFile


            $Location->setDate(new \DateTimeImmutable('now'));

            //dump($produit);
            //

            $manager->persist($Location); // on défini ce qu'on envoie
            $manager->flush(); // envoie de l'objet $produit en BDD dans la table Produit

            //dd($produit);


            // notification
            // methode addFlash() provenant de AbstractController qui permet de véhiculer sur le twig un message
            // 2 arguments :
            // 1e : le nom du flash
            // 2e : le message

            $this->addFlash('success', "La location N° " . $Location->getId() . " a bien été ajouté");


            // Redirection
            // methode redirectToRoute() de AbstractController
            // 2 arguments :
            // 1e obligatoire : name de la route
            // 2e facultatif : tableau


            return $this->redirectToRoute("voiture_afficher");
        }


        return $this->render('bilal_location_de_voitures/locationvoitures.html.twig', [
            "formVoitures" => $form->createView() // méthode permettant de créer la vue du formulaire
        ]);
    }


    /**
     * @Route("/LocationDeVoitures/afficher", name="voiture_afficher")
     */

     public function voiture_afficher (LocationDeVoituresRepository $repoLocation) 
    {

        $locationArray = $repoLocation->findAll();

        return $this->render('bilal_location_de_voitures/afficher.html.twig');
    }

    /**
     * @Route("/LocationDeVoitures/Reserver, name="voiture_reserver")
     */
    

     
}