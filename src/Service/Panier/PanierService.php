<?php

namespace App\Service\Panier;

use App\Repository\LocationDeVoituresRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PanierService
{

    public $session;
    public $locationdevoituresRepository;

    public function __construct(SessionInterface $session, LocationDeVoituresRepository $locationdevoituresRepository)
    {
        $this->session = $session;
        $this->locationdevoituresRepository = $locationdevoituresRepository;
    }

    public function delete(int $id)
    {
        $panier = $this->session->get('panier', []);

        if(!empty($panier[$id])){
            unset($panier[$id]);

            $this->session->set('panier', $panier);
        }
    }

    public function getFullPanier(): array
    {
        $panier = $this->session->get('panier', []);

        $panierDetail = [];

        foreach($panier as $id => $nbreJour){

            $panierDetail[] = [
                'voiture' => $this->locationdevoituresRepository->find($id),
                'nbreJour' => $nbreJour
            ];
        }
        return $panierDetail;
    }


    public function getTotal(): int
    {
        $total = 0;
        foreach($this->getFullPanier() as $voiture){
            $total += $voiture['voiture']->getPrix() * $voiture['nbreJour'];
        }
        return $total;

    }



}