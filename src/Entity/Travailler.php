<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TravaillerRepository")
 */
class Travailler
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Region", inversedBy="travaillers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tra_reg;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Visiteur", inversedBy="travaillers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tra_vis;

    /**
     * @ORM\Column(type="date")
     */
    private $tra_date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tra_role;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTraReg(): ?Region
    {
        return $this->tra_reg;
    }

    public function setTraReg(?Region $tra_reg): self
    {
        $this->tra_reg = $tra_reg;

        return $this;
    }

    public function getTraVis(): ?Visiteur
    {
        return $this->tra_vis;
    }

    public function setTraVis(?Visiteur $tra_vis): self
    {
        $this->tra_vis = $tra_vis;

        return $this;
    }

    public function getTraDate(): ?\DateTimeInterface
    {
        return $this->tra_date;
    }

    public function setTraDate(\DateTimeInterface $tra_date): self
    {
        $this->tra_date = $tra_date;

        return $this;
    }

    public function getTraRole(): ?string
    {
        return $this->tra_role;
    }

    public function setTraRole(string $tra_role): self
    {
        $this->tra_role = $tra_role;

        return $this;
    }
}
