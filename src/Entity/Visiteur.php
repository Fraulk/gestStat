<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VisiteurRepository")
 */
class Visiteur
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
    private $vis_matricule;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vis_nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vis_adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vis_cp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vis_ville;

    /**
     * @ORM\Column(type="date")
     */
    private $vis_dateembauche;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Departement", inversedBy="visiteurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vis_dep;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Secteur", inversedBy="visiteurs")
     */
    private $vis_sec;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVisMatricule(): ?string
    {
        return $this->vis_matricule;
    }

    public function setVisMatricule(string $vis_matricule): self
    {
        $this->vis_matricule = $vis_matricule;

        return $this;
    }

    public function getVisNom(): ?string
    {
        return $this->vis_nom;
    }

    public function setVisNom(string $vis_nom): self
    {
        $this->vis_nom = $vis_nom;

        return $this;
    }

    public function getVisAdresse(): ?string
    {
        return $this->vis_adresse;
    }

    public function setVisAdresse(string $vis_adresse): self
    {
        $this->vis_adresse = $vis_adresse;

        return $this;
    }

    public function getVisCp(): ?string
    {
        return $this->vis_cp;
    }

    public function setVisCp(string $vis_cp): self
    {
        $this->vis_cp = $vis_cp;

        return $this;
    }

    public function getVisVille(): ?string
    {
        return $this->vis_ville;
    }

    public function setVisVille(string $vis_ville): self
    {
        $this->vis_ville = $vis_ville;

        return $this;
    }

    public function getVisDateembauche(): ?\DateTimeInterface
    {
        return $this->vis_dateembauche;
    }

    public function setVisDateembauche(\DateTimeInterface $vis_dateembauche): self
    {
        $this->vis_dateembauche = $vis_dateembauche;

        return $this;
    }

    public function getVisDep(): ?Departement
    {
        return $this->vis_dep;
    }

    public function setVisDep(?Departement $vis_dep): self
    {
        $this->vis_dep = $vis_dep;

        return $this;
    }

    public function getVisSec(): ?Secteur
    {
        return $this->vis_sec;
    }

    public function setVisSec(?Secteur $vis_sec): self
    {
        $this->vis_sec = $vis_sec;

        return $this;
    }
}
