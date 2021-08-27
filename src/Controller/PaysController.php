<?php

namespace App\Controller;

use App\Entity\Pays;
use App\Form\PaysType;
use App\Repository\PaysRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PaysController extends AbstractController
{
   /**
     * @Route("/pays_afficher", name="pays_afficher")
     */
    public function pays_afficher(PaysRepository $repoPays)
    {
        $paysArray = $repoPays->findAll();

        return $this->render('pays/pays_afficher.html.twig', [
            "pays" => $paysArray
        ]);
    }

     /**
     * @Route("/pays_ajouter", name="pays_ajouter")
     */
    public function pays_ajouter(Request $request, EntityManagerInterface $manager)
    {

        $pays = new Pays;

        $form = $this->createForm(PaysType::class, $pays);

        $form->handleRequest($request); 

        if ($form->isSubmitted() && $form->isValid()) {


            $manager->persist($pays); // on défini ce qu'on envoie
            $manager->flush(); // envoie de l'objet $produit en BDD dans la table Produit


            $this->addFlash('success', "Le pays N° " . $pays->getId() . " a bien été ajouté");

            return $this->redirectToRoute("pays_afficher");
        }


        return $this->render('pays/pays_ajouter.html.twig', [
            "formPays" => $form->createView()
        ]);
    }


    /**
     * @Route("/pays_supprimer/{id}", name="pays_supprimer")
     */
    public function pays_supprimer(Pays $pays, EntityManagerInterface $manager)
    {
        $nom = $pays->getName();
        // suppression
        $manager->remove($pays);
        $manager->flush();

        // notification
        $this->addFlash("success", "Le pays $nom a bien été supprimé");


        // redirection
        return $this->redirectToRoute("pays_afficher");

    }
}
