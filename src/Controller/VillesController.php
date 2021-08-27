<?php

namespace App\Controller;

use App\Entity\Villes;
use App\Form\VillesType;
use App\Repository\VillesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VillesController extends AbstractController
{
    /**
     * @Route("/villes_afficher", name="villes_afficher")
     */
    public function villes_afficher(VillesRepository $repoVilles)
    {
        $villesArray = $repoVilles->findAll();

        return $this->render('villes/villes_afficher.html.twig', [
            "villes" => $villesArray
        ]);
    }

     /**
     * @Route("/ville_ajouter", name="ville_ajouter")
     */
    public function ville_ajouter(Request $request, EntityManagerInterface $manager)
    {

        $ville = new Villes;

        $form = $this->createForm(VillesType::class, $ville);

        $form->handleRequest($request); 

        if ($form->isSubmitted() && $form->isValid()) {


            $manager->persist($ville); // on défini ce qu'on envoie
            $manager->flush(); // envoie de l'objet $produit en BDD dans la table Produit


           // $this->addFlash('success', "La ville N° " . $ville->getId() . " a bien été ajouté");

            return $this->redirectToRoute("villes_afficher");
        }


        return $this->render('villes/ville_ajouter.html.twig', [
            "formVille" => $form->createView()
        ]);
    }


    /**
     * @Route("/ville_supprimer/{id}", name="ville_supprimer")
     */
    public function ville_supprimer(Villes $ville, EntityManagerInterface $manager)
    {
        $nom = $ville->getName();
        // suppression
        $manager->remove($ville);
        $manager->flush();

        // notification
        $this->addFlash("success", "La ville $nom a bien été supprimé");


        // redirection
        return $this->redirectToRoute("villes_afficher");

    }
}
