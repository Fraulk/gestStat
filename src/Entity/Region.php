<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private $reg_code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reg_nom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Secteur", mappedBy="region")
     */
    private $reg_sec;

    public function __construct()
    {
        $this->reg_sec = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegCode(): ?string
    {
        return $this->reg_code;
    }

    public function setRegCode(string $reg_code): self
    {
        $this->reg_code = $reg_code;

        return $this;
    }

    public function getRegNom(): ?string
    {
        return $this->reg_nom;
    }

    public function setRegNom(string $reg_nom): self
    {
        $this->reg_nom = $reg_nom;

        return $this;
    }

    /**
     * @return Collection|Secteur[]
     */
    public function getRegSec(): Collection
    {
        return $this->reg_sec;
    }

    public function addRegSec(Secteur $regSec): self
    {
        if (!$this->reg_sec->contains($regSec)) {
            $this->reg_sec[] = $regSec;
            $regSec->setRegion($this);
        }

        return $this;
    }

    public function removeRegSec(Secteur $regSec): self
    {
        if ($this->reg_sec->contains($regSec)) {
            $this->reg_sec->removeElement($regSec);
            // set the owning side to null (unless already changed)
            if ($regSec->getRegion() === $this) {
                $regSec->setRegion(null);
            }
        }

        return $this;
    }
}
