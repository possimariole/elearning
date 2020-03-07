<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnneeAcademiqueRepository")
 */
class AnneeAcademique
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Length(min = 4)
     */
    private $debut;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Length(min = 4)
     */
    private $fin;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Inscription", mappedBy="anneeAcademique")
     * 
     */
    private $inscriptions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Dispenser", mappedBy="anneeAcademique")
     * 
     */
    private $dispensers;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
        $this->dispensers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDebut(): ?int
    {
        return $this->debut;
    }

    public function setDebut(int $debut): self
    {
        $this->debut = $debut;

        return $this;
    }

    public function getFin(): ?int
    {
        return $this->fin;
    }

    public function setFin(int $fin): self
    {
        $this->fin = $fin;

        return $this;
    }

    public function addInscription(Inscription $inscription)
    {
        if(!$this->inscriptions->contains($inscription))
        {
            $this->inscriptions[] = $inscription;
            $inscription->setAnneeAcademique($this);
        }
        return $this;
    }

    public function __toString()
    {
        return (string)$this->debut;
    }

    /**
     * @return Collection|Inscription[]
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function removeInscription(Inscription $inscription): self
    {
        if ($this->inscriptions->contains($inscription)) {
            $this->inscriptions->removeElement($inscription);
            // set the owning side to null (unless already changed)
            if ($inscription->getAnneeAcademique() === $this) {
                $inscription->setAnneeAcademique(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Dispenser[]
     */
    public function getDispensers(): Collection
    {
        return $this->dispensers;
    }

    public function addDispenser(Dispenser $dispenser): self
    {
        if (!$this->dispensers->contains($dispenser)) {
            $this->dispensers[] = $dispenser;
            $dispenser->setAnneeAcademique($this);
        }

        return $this;
    }

    public function removeDispenser(Dispenser $dispenser): self
    {
        if ($this->dispensers->contains($dispenser)) {
            $this->dispensers->removeElement($dispenser);
            // set the owning side to null (unless already changed)
            if ($dispenser->getAnneeAcademique() === $this) {
                $dispenser->setAnneeAcademique(null);
            }
        }

        return $this;
    }
}
