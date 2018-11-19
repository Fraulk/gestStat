<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RegionRepository")
 */
class Region
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
    private $Nom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Secteur", inversedBy="regions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Secteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getSecteur(): ?Secteur
    {
        return $this->Secteur;
    }

    public function setSecteur(?Secteur $Secteur): self
    {
        $this->Secteur = $Secteur;

        return $this;
    }
}
