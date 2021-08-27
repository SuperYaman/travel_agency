<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\PromateType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PromateController extends AbstractController
{
     /**
     * @Route("/promate_{id<\d+>}", name="promate")
     */
    public function promateToAdmin($id, Request $request, EntityManagerInterface $manager)
    {
        $secret = "admin";

        $form = $this->createForm(PromateType::class);
        $form->handleRequest($request);

        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        if(!$user)
        {
            $this->addFlash('erreur', 'l\'utilisateur n\éxiste pas !');
        }

        if($form->isSubmitted() && $form->isValid())
        {
           
            if($form->get("secret")->getData() != $secret )
            {
                throw $this->createNotFoundException("vous n'avez pas le bon code, vous êtes un intrus ! ! !");
            }

            $user->setRoles(["ROLE_ADMIN"]);
            
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('registration');
        }

        return $this->render("promate/promate.html.twig",[
            "formPromate" => $form->createView(),
            "user" => $user
        ]);
    }  
}
