<?php

namespace App\Controller;

use App\Entity\Pays;
use App\Repository\LocationDeVoituresRepository;
use App\Repository\PaysRepository;
use App\Repository\VillesRepository;
use App\Repository\VolRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NicoleController extends AbstractController
{
    /**
     * @Route("/nicole/home", name="nicole")
     */
    public function index(PaysRepository $repoPays, VillesRepository $repoVilles): Response
    {
        $paysArray = $repoPays->findAll();
        //dd($paysArray);
        $villesArray = $repoVilles->findAll();
        //dd($reposVilles);

        return $this->render('nicole/index.html.twig', [
            'controller_name' => 'NicoleController',
            "pays" => $paysArray,
            "villes" => $villesArray,
        ]);
    }

    /**
     * @Route("/nicole/vols", name="vols")
     */
    public function vols(): Response
    {
        return $this->render('nicole/vols.html.twig', [
        ]);
    }

    /**
     * @Route("/nicole/hotels", name="hotels")
     */
    public function hotels(PaysRepository $repoPays, VillesRepository $repoVilles): Response
    {
        $paysArray = $repoPays->findAll();
        //dd($paysArray);
        $villesArray = $repoVilles->findAll();
        //dd($reposVilles);

        return $this->render('nicole/hotels.html.twig', [
            'controller_name' => 'NicoleController',
            "pays" => $paysArray,
            "villes" => $villesArray,
        ]);
    }


    /**
     * @Route("/nicole/locations", name="locations")
     */
    public function locations(): Response
    {
        return $this->render('nicole/locations.html.twig', [
        ]);
    }


    /**
     * @Route("/nicole/formules", name="formules")
     */
    public function formules(): Response
    {
        return $this->render('nicole/formules.hmtl.twig', [

        ]);
    }

    /**
     * @Route("/nicole/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('nicole/contact.html.twig', [

        ]);
    }

    /**
     * @Route("/nicole/one-hotel", name="hotel")
     */
    public function ohotel(): Response
    {
        return $this->render('nicole/one-hotel.html.twig', [

        ]);
    }

    /**
     *@Route("/nicole/catalogue-voitures", name="voitures")
     */
    public function catv(): Response
    {
        return $this->render('nicole/catalogue-voitures.html.twig', [

        ]);
    }

    /**
     * @Route("/nicole/catalogue-hotels", name="reservation-hotels")
     */
    public function cathotels(): Response
    {
        return $this->render('nicole/catalogue-hotels.html.twig', [

        ]);
    }

    /**
     * @Route("/nicole/catalogue-vols", name="reservation-vols")
     */
    public function catvols(Request $request, VolRepository $volRepository): Response
    {

        $villeDepart=$request->request->get('depart');
        $villeArrivee=$request->request->get('arrivee');
        $date=$request->request->get('check-in');

        $dated=date_create($date);
        $datepluscinqd=date('Y-m-d', strtotime('+5 days', strtotime($date)));
        $datemoinscinqd=date('Y-m-d', strtotime('-5 days', strtotime($date)));
        $datemoinscinq=new \DateTime($datemoinscinqd);
        $datepluscinq=new \DateTime($datepluscinqd);

        $volsj=$volRepository->findByVilleDate($dated, $villeDepart, $villeArrivee);
        $volsjmoinscinq=$volRepository->findByVilleDatemoinscinq($dated, $villeDepart, $villeArrivee, $datemoinscinq);
        $volsjpluscinq=$volRepository->findByVilleDatepluscinq($dated, $villeDepart, $villeArrivee, $datepluscinq);

        // dd($date,$dated,$datepluscinq,$volsjpluscinq);
        return $this->render('nicole/catalogue-vols.html.twig', [
            "vols" => $volsj,
            "volsp" => $volsjmoinscinq,
            "volsa" => $volsjpluscinq,

        ]);
    }

    /**
     * @Route("/nicole/catalogue-formules", name="reservation-formules")
     */
    public function catformules(): Response
    {
        return $this->render('nicole/catalogue-formules.html.twig', [

        ]);
    }


    /**
     * @Route("/nicole/catalogue-voitures", name="reservation-voitures")
     */
    public function catvoitures(Request $request, LocationDeVoituresRepository $locationDeVoituresRepository): Response
    {

        $prixencharge =$request->request->get('depart');
        $restitution =$request->request->get('arrivee');
        $date=$request->request->get('check-in');

        $dated=date_create($date);
        $datepluscinqd=date('Y-m-d', strtotime('+5 days', strtotime($date)));
        $datemoinscinqd=date('Y-m-d', strtotime('-5 days', strtotime($date)));
        $datemoinscinq=new \DateTime($datemoinscinqd);
        $datepluscinq=new \DateTime($datepluscinqd);

        $locationsj=$locationDeVoituresRepository->findByVilleDate($dated, $prixencharge, $restitution);
        $locationsjmoinscinq=$locationDeVoituresRepository->findByVilleDatemoinscinq($dated, $prixencharge, $restitution, $datemoinscinq);
        $locationsjpluscinq=$locationDeVoituresRepository->findByVilleDatepluscinq($dated, $prixencharge, $restitution, $datepluscinq);

        dd($date,$dated,$datepluscinq,$locationsjpluscinq);

        return $this->render('nicole/catalogue-voitures.html.twig', [

        ]);
    }



}
