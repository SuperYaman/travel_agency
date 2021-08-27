<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VilleRepository::class)
 */
class Ville
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
    private $nom;

    /**
     * @ORM\ManyToMany(targetEntity=Vol::class, mappedBy="villeDepart")
     */
    private $vols;

    public function __construct()
    {
        $this->vols = new ArrayCollection();
    }

    
    
    
    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Vol[]
     */
    public function getVols(): Collection
    {
        return $this->vols;
    }

    public function addVol(Vol $vol): self
    {
        if (!$this->vols->contains($vol)) {
            $this->vols[] = $vol;
            $vol->addVilleDepart($this);
        }

        return $this;
    }

    public function removeVol(Vol $vol): self
    {
        if ($this->vols->removeElement($vol)) {
            $vol->removeVilleDepart($this);
        }

        return $this;
    }

  
    
    

}