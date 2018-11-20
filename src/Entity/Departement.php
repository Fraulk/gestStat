<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DepartementRepository")
 */
class Departement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dep_code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dep_nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dep_chefvente;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Visiteur", mappedBy="vis_dep")
     */
    private $visiteurs;

    public function __construct()
    {
        $this->visiteurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDepCode(): ?string
    {
        return $this->dep_code;
    }

    public function setDepCode(string $dep_code): self
    {
        $this->dep_code = $dep_code;

        return $this;
    }

    public function getDepNom(): ?string
    {
        return $this->dep_nom;
    }

    public function setDepNom(string $dep_nom): self
    {
        $this->dep_nom = $dep_nom;

        return $this;
    }

    public function getDepChefvente(): ?string
    {
        return $this->dep_chefvente;
    }

    public function setDepChefvente(string $dep_chefvente): self
    {
        $this->dep_chefvente = $dep_chefvente;

        return $this;
    }

    /**
     * @return Collection|Visiteur[]
     */
    public function getVisiteurs(): Collection
    {
        return $this->visiteurs;
    }

    public function addVisiteur(Visiteur $visiteur): self
    {
        if (!$this->visiteurs->contains($visiteur)) {
            $this->visiteurs[] = $visiteur;
            $visiteur->setVisDep($this);
        }

        return $this;
    }

    public function removeVisiteur(Visiteur $visiteur): self
    {
        if ($this->visiteurs->contains($visiteur)) {
            $this->visiteurs->removeElement($visiteur);
            // set the owning side to null (unless already changed)
            if ($visiteur->getVisDep() === $this) {
                $visiteur->setVisDep(null);
            }
        }

        return $this;
    }
}
