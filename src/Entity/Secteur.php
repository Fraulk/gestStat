<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SecteurRepository")
 */
class Secteur
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
    private $sec_code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sec_libelle;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Visiteur", mappedBy="vis_sec")
     */
    private $visiteurs;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Region", inversedBy="reg_sec")
     * @ORM\JoinColumn(nullable=false)
     */
    private $region;

    public function __construct()
    {
        $this->visiteurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSecCode(): ?string
    {
        return $this->sec_code;
    }

    public function setSecCode(string $sec_code): self
    {
        $this->sec_code = $sec_code;

        return $this;
    }

    public function getSecLibelle(): ?string
    {
        return $this->sec_libelle;
    }

    public function setSecLibelle(string $sec_libelle): self
    {
        $this->sec_libelle = $sec_libelle;

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
            $visiteur->setVisSec($this);
        }

        return $this;
    }

    public function removeVisiteur(Visiteur $visiteur): self
    {
        if ($this->visiteurs->contains($visiteur)) {
            $this->visiteurs->removeElement($visiteur);
            // set the owning side to null (unless already changed)
            if ($visiteur->getVisSec() === $this) {
                $visiteur->setVisSec(null);
            }
        }

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(?Region $region): self
    {
        $this->region = $region;

        return $this;
    }
}
