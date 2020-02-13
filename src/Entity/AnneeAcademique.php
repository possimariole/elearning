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
     * * @Assert\Length(min = 4)
     */
    private $debut;

    /**
     * @ORM\Column(type="integer")
     * * @Assert\Length(min = 4)
     */
    private $fin;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Inscription", mappedBy="anneeAcademique")
     * @Assert\Type("float")
     */
    private $inscriptions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Dispenser", mappedBy="anneeAcademique")
     * @Assert\Blank()
     */
    private $dispensers;

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
    /**
     * @return collection\inscriptions;
     */
    public function getInscription(): Collection
    {
        return $this->inscriptions;
    }

    public function removeElement(Inscription $inscription): self
    {
        if($this->inscritions->contains($inscription))
        {
            $this->inscriptions->removeElement($inscription);
            if($inscription->getAnneeAcademique() === $this); 
            {
                $inscription->setAnneeAcademique(null);
            }
        }
        return $this;
    }

    public function addDispenser(Dispenser $dispenser)
    {
        if(!$this->dispensers->contains($dispenser))
        {
            $this->dispensers[] = $dispenser;
            $dispenser->setAnneeAcademique($this);
        }
        return $this;
    }
    /**
     * @return collection\Dispensers[];
     */
    public function getdispenser(): Collection
    {
        return $this->dispensers;
    }

    public function removeDispenser(Dispenser $Dispenser): self
    {
        if($this->dispensers->contains($dispenser))
        {
            $this->dispensers->removeElement($dispenser);
            if($dispenser->getAnneeAcademique() === $this)
            {
                $dispenser->setAnneeAcademique(null);
            }
        }
          return $this;
    }

    public function __toString()
    {
        return (string)$this->debut;
    }
}
