<?php

namespace App\Entity;

use App\Repository\VolRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VolRepository::class)
 */
class Vol
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numeroVol;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomCompagny;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDepart;

    /**
     * @ORM\Column(type="date")
     */
    private $dateArrivee;

    /**
     * @ORM\Column(type="time")
     */
    private $heureDepart;

    /**
     * @ORM\Column(type="time")
     */
    private $heureArrivee;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity=Villes::class, inversedBy="volsDepart", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $villeDepart;

    /**
     * @ORM\ManyToOne(targetEntity=Villes::class, inversedBy="volsArrivee")
     * @ORM\JoinColumn(nullable=false)
     */
    private $villeArrivee;




    public function getId(): ?int
    {
        return $this->id;

    }

    public function getNumeroVol(): ?string
    {
        return $this->numeroVol;
    }

    public function setNumeroVol(string $numeroVol): self
    {
        $this->numeroVol = $numeroVol;

        return $this;
    }

    public function getNomCompagny(): ?string
    {
        return $this->nomCompagny;
    }

    public function setNomCompagny(string $nomCompagny): self
    {
        $this->nomCompagny = $nomCompagny;

        return $this;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->dateDepart;
    }

    public function setDateDepart(\DateTimeInterface $dateDepart): self
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    public function getDateArrivee(): ?\DateTimeInterface
    {
        return $this->dateArrivee;
    }

    public function setDateArrivee(\DateTimeInterface $dateArrivee): self
    {
        $this->dateArrivee = $dateArrivee;

        return $this;
    }

    public function getHeureDepart(): ?\DateTimeInterface
    {
        return $this->heureDepart;
    }

    public function setHeureDepart(\DateTimeInterface $heureDepart): self
    {
        $this->heureDepart = $heureDepart;

        return $this;
    }


    public function getHeureArrivee(): ?\DateTimeInterface
    {
        return $this->heureArrivee;
    }

    public function setHeureArrivee(\DateTimeInterface $heureArrivee): self
    {
        $this->heureArrivee = $heureArrivee;

        return $this;
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
