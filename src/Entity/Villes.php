<?php

namespace App\Entity;

use App\Repository\VillesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VillesRepository::class)
 */
class Villes
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
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Pays::class, inversedBy="villes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pays;

    /**
     * @ORM\OneToMany(targetEntity=Hotel::class, mappedBy="ville")
     */
    private $hotel;

    /**
     * @ORM\OneToMany(targetEntity=Vol::class, mappedBy="villeDepart")
     */
    private $volsDepart;

    /**
     * @ORM\OneToMany(targetEntity=Vol::class, mappedBy="villeArrivee")
     */
    private $volsArrivee;

    /**
     * @ORM\OneToMany(targetEntity=LocationDeVoitures::class, mappedBy="villeDepart")
     */
    private $locationDeVoitures;

    /**
     * @ORM\OneToMany(targetEntity=LocationDeVoitures::class, mappedBy="villeArrivee")
     */
    private $locationDeVoituresD;




    public function __construct()
    {
        $this->hotels = new ArrayCollection();
        $this->hotel = new ArrayCollection();
        $this->departVols = new ArrayCollection();
        $this->volsDepart = new ArrayCollection();
        $this->volsArrivee = new ArrayCollection();
        $this->locationDeVoitures = new ArrayCollection();
        $this->locationDeVoituresD = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * @return Collection|Hotel[]
     */
    public function getHotel(): Collection
    {
        return $this->hotel;
    }

    public function addHotel(Hotel $hotel): self
    {
        if (!$this->hotel->contains($hotel)) {
            $this->hotel[] = $hotel;
            $hotel->setVille($this);
        }

        return $this;
    }

    public function removeHotel(Hotel $hotel): self
    {
        if ($this->hotel->removeElement($hotel)) {
            // set the owning side to null (unless already changed)
            if ($hotel->getVille() === $this) {
                $hotel->setVille(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Vol[]
     */
    public function getVolsDepart(): Collection
    {
        return $this->volsDepart;
    }

    public function addVolsDepart(Vol $volsDepart): self
    {
        if (!$this->volsDepart->contains($volsDepart)) {
            $this->volsDepart[] = $volsDepart;
            $volsDepart->setVilleDepart($this);
        }

        return $this;
    }

    public function removeVolsDepart(Vol $volsDepart): self
    {
        if ($this->volsDepart->removeElement($volsDepart)) {
            // set the owning side to null (unless already changed)
            if ($volsDepart->getVilleDepart() === $this) {
                $volsDepart->setVilleDepart(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Vol[]
     */
    public function getVolsArrivee(): Collection
    {
        return $this->volsArrivee;
    }

    public function addVolsArrivee(Vol $volsArrivee): self
    {
        if (!$this->volsArrivee->contains($volsArrivee)) {
            $this->volsArrivee[] = $volsArrivee;
            $volsArrivee->setVilleArrivee($this);
        }

        return $this;
    }

    public function removeVolsArrivee(Vol $volsArrivee): self
    {
        if ($this->volsArrivee->removeElement($volsArrivee)) {
            // set the owning side to null (unless already changed)
            if ($volsArrivee->getVilleArrivee() === $this) {
                $volsArrivee->setVilleArrivee(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|LocationDeVoitures[]
     */
    public function getLocationDeVoitures(): Collection
    {
        return $this->locationDeVoitures;
    }

    public function addLocationDeVoiture(LocationDeVoitures $locationDeVoiture): self
    {
        if (!$this->locationDeVoitures->contains($locationDeVoiture)) {
            $this->locationDeVoitures[] = $locationDeVoiture;
            $locationDeVoiture->setVilleDepart($this);
        }

        return $this;
    }

    public function removeLocationDeVoiture(LocationDeVoitures $locationDeVoiture): self
    {
        if ($this->locationDeVoitures->removeElement($locationDeVoiture)) {
            // set the owning side to null (unless already changed)
            if ($locationDeVoiture->getVilleDepart() === $this) {
                $locationDeVoiture->setVilleDepart(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|LocationDeVoitures[]
     */
    public function getLocationDeVoituresD(): Collection
    {
        return $this->locationDeVoituresD;
    }

    public function addLocationDeVoituresD(LocationDeVoitures $locationDeVoituresD): self
    {
        if (!$this->locationDeVoituresD->contains($locationDeVoituresD)) {
            $this->locationDeVoituresD[] = $locationDeVoituresD;
            $locationDeVoituresD->setVilleArrivee($this);
        }

        return $this;
    }

    public function removeLocationDeVoituresD(LocationDeVoitures $locationDeVoituresD): self
    {
        if ($this->locationDeVoituresD->removeElement($locationDeVoituresD)) {
            // set the owning side to null (unless already changed)
            if ($locationDeVoituresD->getVilleArrivee() === $this) {
                $locationDeVoituresD->setVilleArrivee(null);
            }
        }

        return $this;
    }

    }