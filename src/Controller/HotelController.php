<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Form\HotelType;
use App\Repository\HotelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HotelController extends AbstractController
{
    /**
     * @Route("/hotel_afficher", name="hotel_afficher")
     */
    public function produit_afficher(HotelRepository $repoHotel)
    {
        $hotelsArray = $repoHotel->findAll();
        //dd($hotelsArray);

        return $this->render('hotel/hotel_afficher.html.twig', [
            "hotels" => $hotelsArray
        ]);
    }

     /**
     * @Route("/hotel_ajouter", name="hotel_ajouter")
     */
    public function addHotel(Request $request, EntityManagerInterface $manager)
    {

        $hotel = new Hotel;

        $form = $this->createForm(HotelType::class, $hotel, [
            "ajouter"=> true
        ]);

        $form->handleRequest($request); 

        if ($form->isSubmitted() && $form->isValid()) {

             $imageFile = $form->get('image')->getData();
            // $imageFile est soit un objet soit null
            //dd($imageFile);


            if ($imageFile) // si $imageFile n'est pas vide/null (une image a été upload/chargée)
            {
                // Traitement de l'image
                // 3 étapes

                // 1e étape : renommer le nom de l'image

                $nomImage = date("YmdHis") . "-" . uniqid() . "-" . $imageFile->getClientOriginalName();
                //dd($nomImage);


                // 2e étape : Envoyer l'image dans le dossier public / images / imagesUpload

                // move() permet de déplacer le fichier
                // 2 arguments :
                // 1e : emplacement : getParameter()        // où déplacer l'image ???
                // 2e : le nom du fichier qu'on déplace      // sous quel nom ???

                $imageFile->move(
                    $this->getParameter("image_hotel"),
                    $nomImage
                );

                /*
                    la méthode getParameter() renvoie sur le fichier config/services.yaml aux paramètres (ligne 6)
                    les paramètres définissent un emplacement 
                    1 argument : le nom du paramètre
                */


                // 3e étape : envoyer le nom de l'image en bdd

                $hotel->setImage($nomImage); 


            }// fermeture de la condition $imageFile
            


            //$hotel->setDateAt(new \DateTimeImmutable('now'));

            //dump($produit);
            //

            $manager->persist($hotel); // on défini ce qu'on envoie
            $manager->flush(); // envoie de l'objet $produit en BDD dans la table Produit

            //dd($produit);


            // notification 
            // methode addFlash() provenant de AbstractController qui permet de véhiculer sur le twig un message
            // 2 arguments :
            // 1e : le nom du flash
            // 2e : le message

            $this->addFlash('success', "L'hotel N° " . $hotel->getId() . " a bien été ajouté");


            // Redirection
            // methode redirectToRoute() de AbstractController
            // 2 arguments :
            // 1e obligatoire : name de la route
            // 2e facultatif : tableau


            return $this->redirectToRoute("hotel_afficher");
        }


        return $this->render('hotel/hotel_ajouter.html.twig', [
            "formHotel" => $form->createView()
        ]);
    }


    /**
     * @Route("/hotel_supprimer/{id}", name="hotel_supprimer")
     */
    public function hotel_supprimer(Hotel $hotel, EntityManagerInterface $manager)
    {
        // si $hotel a une image alors il faut également la supprimer
        if ($hotel->getImage()) // si l'image n'est pas null
        {
            //  unlink($this->getParameter("image_produit") . "/" . $produit->getImage());
            //unlink() permet de supprimer un fichier
            // 1e argument : le chemin jusqu'au fichier
        }

        $nom = $hotel->getName();
        // suppression
        $manager->remove($hotel);
        $manager->flush();

        // notification
        $this->addFlash("success", "L'hotel $nom a bien été supprimé");


        // redirection
        return $this->redirectToRoute("hotel_afficher");

    }

    /**
     * @Route("hotel_modifier/{id}", name="hotel_modifier")
     */
    public function hotel_modifier(Hotel $hotel, Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(HotelType::class, $hotel, [
            "modifier" => true
        ]);

        $form->handleRequest($request); // traitement du formulaire

        // si le formulaire a été soumis (clic sur le bouton "Ajouter" : type="submit")
        // et si le formulaire est valide (contraintes : il respecte toutes les conditions : ex: prix, titre non vides)
        if ($form->isSubmitted() && $form->isValid()) {
            //dump($produit);

            //dd($produit->getTitre());

            $imageModif = $form->get('imageModif')->getData();
            // $imageFile est soit un objet soit null
            //dd($imageModif);
            $image1Modif = $form->get('image1Modif')->getData();
            // $imageFile est soit un objet soit null
            //dd($imageFile);
            $image2Modif = $form->get('image2Modif')->getData();
            // $imageFile est soit un objet soit null
            //dd($imageFile);


            if ($imageModif) // si $imageFile n'est pas vide/null (une image a été upload/chargée)
            {
                // Traitement de l'image
                // 3 étapes

                // 1e étape : renommer le nom de l'image

                $nomImage = date("YmdHis") . "-" . uniqid() . "-" . $imageModif->getClientOriginalName();
                //dd($nomImage);


                // 2e étape : Envoyer l'image dans le dossier public / images / imagesUpload

                // move() permet de déplacer le fichier
                // 2 arguments :
                // 1e : emplacement : getParameter()        // où déplacer l'image ???
                // 2e : le nom du fichier qu'on déplace      // sous quel nom ???

                $imageModif->move(
                    $this->getParameter("image_hotel"),
                    $nomImage
                );

                /*
                    la méthode getParameter() renvoie sur le fichier config/services.yaml aux paramètres (ligne 6)
                    les paramètres définissent un emplacement 
                    1 argument : le nom du paramètre
                */


                // 3e étape : envoyer le nom de l'image en bdd

                $hotel->setImage($nomImage);


            }// fermeture de la condition $imageFile

            
            
            if ($image1Modif) // si $imageFile n'est pas vide/null (une image a été upload/chargée)
            {
                // Traitement de l'image
                // 3 étapes

                // 1e étape : renommer le nom de l'image

                $nomImage1 = date("YmdHis") . "-" . uniqid() . "-" . $image1Modif->getClientOriginalName();
                //dd($nomImage);


                // 2e étape : Envoyer l'image dans le dossier public / images / imagesUpload

                // move() permet de déplacer le fichier
                // 2 arguments :
                // 1e : emplacement : getParameter()        // où déplacer l'image ???
                // 2e : le nom du fichier qu'on déplace      // sous quel nom ???

                $image1Modif->move(
                    $this->getParameter("image_hotel1"),
                    $nomImage1
                );

                /*
                    la méthode getParameter() renvoie sur le fichier config/services.yaml aux paramètres (ligne 6)
                    les paramètres définissent un emplacement 
                    1 argument : le nom du paramètre
                */


                // 3e étape : envoyer le nom de l'image en bdd

                $hotel->setImage1($nomImage1);


            }// fermeture de la condition $imageFile

            if ($image2Modif) // si $imageFile n'est pas vide/null (une image a été upload/chargée)
            {
                // Traitement de l'image
                // 3 étapes

                // 1e étape : renommer le nom de l'image

                $nomImage2 = date("YmdHis") . "-" . uniqid() . "-" . $image2Modif->getClientOriginalName();
                //dd($nomImage);


                // 2e étape : Envoyer l'image dans le dossier public / images / imagesUpload

                // move() permet de déplacer le fichier
                // 2 arguments :
                // 1e : emplacement : getParameter()        // où déplacer l'image ???
                // 2e : le nom du fichier qu'on déplace      // sous quel nom ???

                $image2Modif->move(
                    $this->getParameter("image_hotel2"),
                    $nomImage2
                );

                /*
                    la méthode getParameter() renvoie sur le fichier config/services.yaml aux paramètres (ligne 6)
                    les paramètres définissent un emplacement 
                    1 argument : le nom du paramètre
                */


                // 3e étape : envoyer le nom de l'image en bdd

                $hotel->setImage2($nomImage2);


            }// fermeture de la condition $imageFile


            //dump($produit);
            //

            $manager->persist($hotel); // on défini ce qu'on envoie
            $manager->flush(); // envoie de l'objet $produit en BDD dans la table Produit

            //dd($produit);


            // notification 
            // methode addFlash() provenant de AbstractController qui permet de véhiculer sur le twig un message
            // 2 arguments :
            // 1e : le nom du flash
            // 2e : le message

            $this->addFlash('success', "L'hotel N° " . $hotel->getId() . " a bien été modifié");


            // Redirection
            // methode redirectToRoute() de AbstractController
            // 2 arguments :
            // 1e obligatoire : name de la route
            // 2e facultatif : tableau


            return $this->redirectToRoute("hotel_afficher");
        }


        return $this->render("hotel/hotel_modifier.html.twig", [
            "formHotel" => $form->createView(),
            "hotel" => $hotel
        ]);
    }
}

