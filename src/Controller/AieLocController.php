<?php

namespace App\Controller;

use App\Entity\LocationDeVoitures;
use App\Form\LocationDeVoituresType;
use App\Repository\LocationDeVoituresRepository;
use App\Service\Panier\PanierService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AieLocController extends AbstractController
{
    /**
     * @Route("/adminloc/afficher", name="voiture_afficher")
     */
    public function voiture_afficher(LocationDeVoituresRepository $locationDeVoituresRepository)
    {
        $locVoiture = $locationDeVoituresRepository->findAll();

        return $this->render('aie_loc/voiture_afficher.html.twig', [
            'voitures' => $locVoiture
        ]);
    }



    /**
     * @Route("/adminloc/ajouter", name="voiture_ajouter")
     */
    public function voiture_ajouter(Request $request, EntityManagerInterface $manager)
    {
        $voiture = new LocationDeVoitures;

        $form = $this->createForm(LocationDeVoituresType::class, $voiture, array('ajouter' => true));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $imageFile = $form->get('image')->getData();

            if ($imageFile) {

                $nomImage = date("YmdHis") . "-" . $imageFile->getClientOriginalName();
                $imageFile->move(
                    $this->getParameter('image_voiture'),
                    $nomImage
                );

                $voiture->setImage($nomImage);
            }

            $manager->persist($voiture);
            $manager->flush();
            $this->addFlash('success', 'Voiture ajouté!');

            return $this->redirectToRoute('voiture_afficher');

        }

        return $this->render('aie_loc/voiture_ajouter.html.twig', [
            "formVoiture" => $form->createView()
        ]);


    }

    /**
     * @Route("/adminloc/supprimer/{id}", name="voiture_supprimer")
     */
    public function voiture_supprimer($id, EntityManagerInterface $manager,LocationDeVoitures $locationDeVoitures)
    {

        $manager->remove($locationDeVoitures);
        $manager->flush();
        $this->addFlash('success', 'Voiture supprimée!');
        
        return $this->redirectToRoute('voiture_afficher');
        
    }
    
    /**
     * @Route("/adminloc/modifier/{id}", name="voiture_modifier")
     */
    public function voiture_modifier(Request $request,LocationDeVoitures $locationDeVoitures, EntityManagerInterface $manager )
    {

        $form = $this->createForm(LocationdevoituresType::class, $locationDeVoitures, array('modifier' => true));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $imageModif = $form->get('imageModif')->getData();
            $imageModif1 = $form->get('imageModif1')->getData();
            $imageModif2 = $form->get('imageModif2')->getData();

            if ($imageModif) {
                $nomImage = date("YmdHis") . "-" . $imageModif->getClientOriginalName();
                $imageModif->move(
                    $this->getParameter('image_voiture'),
                    $nomImage
                );

                $locationDeVoitures->setImage($nomImage);
            }
            if ($imageModif1) {
                $nomImage1 = date("YmdHis") . "-" . $imageModif1->getClientOriginalName();
                $imageModif1->move(
                    $this->getParameter('image_voiture1'),
                    $nomImage1
                );

                $locationDeVoitures->setImage($nomImage1);
            }
            if ($imageModif2) {
                $nomImage2 = date("YmdHis") . "-" . $imageModif2->getClientOriginalName();
                $imageModif2->move(
                    $this->getParameter('image_voiture2'),
                    $nomImage2
                );

                $locationDeVoitures->setImage($nomImage2);
            }

            $manager->persist($locationDeVoitures);
            $manager->flush();
            $this->addFlash('success', 'Voiture modifiée!');

            return $this->redirectToRoute('voiture_afficher');
        }

        return $this->render('/aie_loc/voiture_modifier.html.twig', [
            'formVoiture' => $form->createView(),
            "voiture" => $locationDeVoitures
        ]);
    }


    /**
     * @Route("/cart", name="cart")
     */
    public function cart(PanierService $panierService)
    {
        $panier = $panierService->getFullPanier();

        return $this->render('aie_loc/cart.html.twig', [
            'panier' => $panier
        ]);

    }

    /**
     * @Route("/deleteCart/{id}", name="deleteCart")
     */
    public function deleteCart(PanierService $panierService, $id)
    {
        $panierService->delete($id);

        $this->addFlash('success', 'Voiture supprimée du panier!');
        return $this->redirectToRoute('/cart');
    }














}
