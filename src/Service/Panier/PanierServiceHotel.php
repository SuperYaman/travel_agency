<?php

namespace App\Service\Panier;


use App\Repository\HotelRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PanierServiceHotel
{


    public $session;
    public $hotelRepository;

    // ici on créé le constrsteur qui sera appelé immédiatement à l'appel de notre PanierService
    //et chargera automaquement ici la session ainsi que le repository de produit afin d'accéder au détail de ces produit via leur id
    public function __construct(SessionInterface $session, HotelRepository $hotelRepository)
    {
        $this->session = $session;
        $this->hotelRepository = $hotelRepository;
    }

    public function add(int $id, $nbreadult, $nbreenfant)
    {

        // ici déclaration en session d'un panier qui si inexistant sera initialisé à un array vide.
        // On pose la condition de la présence d'un id de produit dans le panier afiin de définir si la quantite doit être initialisée à 1 dans le cas d'un premier ajout ou incrémenté dans le cas d'ajouts supplémentaires.

        $panier = $this->session->get('panier', []);

        if (!empty($panier[$id])):
            $panier[$id]++;
        $panier['nbreadult']=$nbreadult;
        $panier['nbreenfant']=$nbreenfant;
        else:
            $panier[$id] = 1;
        endif;

        $this->session->set('panier', $panier);

    }


    public function remove(int $id)
    {

        $panier = $this->session->get('panier', []);
//dd($panier[$id]);
        // dd($panier[$id]);
        if (!empty($panier[$id]) && $panier[$id]!==1):
            $panier[$id]--;
        elseif (!empty($panier[$id]) && $panier[$id] ==1):

            unset($panier[$id]);
        endif;

        $this->session->set('panier', $panier);
    }

    public function delete(int $id)
    {

        $panier = $this->session->get('panier', []);

        //ici on supprime totalement la ligne du panier correspondant à l'id du produit
        //peut importe sa quantité
        if (!empty($panier[$id])):
            unset($panier[$id]);
        endif;

        $this->session->set('panier', $panier);
    }


    public function getFullPanier(): array
    {
        $panier = $this->session->get('panier', []);

        $panierDetail = [];

        $panierDetail[]=['adultes'=>$panier['nbreadult']];
        $panierDetail[]=['enfants'=>$panier['nbreenfant']];

        foreach ($panier as $id => $nbrJour):

            $panierDetail[] = [
                'hotel' => $this->hotelRepository->find($id)
            ];

        endforeach;

        return $panierDetail;

    }

}
