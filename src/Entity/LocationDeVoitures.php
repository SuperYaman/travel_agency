<?php

namespace App\Entity;

use App\Repository\LocationDeVoituresRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LocationDeVoituresRepository::class)
 */
class LocationDeVoitures
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $modele;


    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="date")
     */
    private $dateRetour;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image2;

    public $imageModif;

    public $imageModif1;

    public $imageModif2;

    /**
     * @ORM\ManyToOne(targetEntity=Villes::class, inversedBy="locationDeVoitures", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $villeDepart;

    /**
     * @ORM\ManyToOne(targetEntity=Villes::class, inversedBy="locationDeVoituresD")
     * @ORM\JoinColumn(nullable=false)
     */
    private $villeArrivee;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }


    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDateRetour(): ?\DateTimeInterface
    {
        return $this->dateRetour;
    }

    public function setDateRetour(\DateTimeInterface $dateRetour): self
    {
        $this->dateRetour = $dateRetour;

        return $this;
    }

    public function getImage1(): ?string
    {
        return $this->image1;
    }

    public function setImage1(string $image1): self
    {
        $this->image1 = $image1;

        return $this;
    }

    public function getImage2(): ?string
    {
        return $this->image2;
    }

    public function setImage2(string $image2): self
    {
        $this->image2 = $image2;

        return $this;
    }

    public function getVilleDepart(): ?Villes
    {
        return $this->villeDepart;
    }

    public function setVilleDepart(?Villes $villeDepart): self
    {
        $this->villeDepart = $villeDepart;

        return $this;
    }

    public function getVilleArrivee(): ?Villes
    {
        return $this->villeArrivee;
    }

    public function setVilleArrivee(?Villes $villeArrivee): self
    {
        $this->villeArrivee = $villeArrivee;

        return $this;
    }
}
