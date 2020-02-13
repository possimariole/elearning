<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DispenserRepository")
 */
class Dispenser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     *  Assert\date
     * @var string A "y-m-d"formatted value
     */
    private $debut;

    /**
     * @ORM\Column(type="date")
     *  Assert\date
     * @var string A "y-m-d"formatted value
     */
    private $fin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Enseignant", inversedBy="dispensers")
     */
    private $enseignant;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AnneeAcademique", inversedBy="dispensers")
     * @Assert\Length(min=4)
     */
    private $anneeAcademique;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Matiere", inversedBy="dispensers")
     */
    private $matiere;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDebut(): ?\DateTimeInterface
    {
        return $this->debut;
    }

    public function setDebut(\DateTimeInterface $debut): self
    {
        $this->debut = $debut;

        return $this;
    }

    public function getFin(): ?\DateTimeInterface
    {
        return $this->fin;
    }

    public function setFin(\DateTimeInterface $fin): self
    {
        $this->fin = $fin;

        return $this;
    }

    public function __toString()
    {
        return (string)$this->debut;
    }

    public function getEnseignant(): ?Enseignant
    {
        return $this->enseignant;
    }

    public function setEnseignant(?Enseignant $enseignant): self
    {
        $this->enseignant = $enseignant;

        return $this;
    }

    public function getAnneeAcademique(): ?AnneeAcademique
    {
        return $this->anneeAcademique;
    }

    public function setAnneeAcademique(?AnneeAcademique $anneeAcademique): self
    {
        $this->anneeAcademique = $anneeAcademique;

        return $this;
    }

    public function getMatiere(): ?Matiere
    {
        return $this->matiere;
    }

    public function setMatiere(?Matiere $matiere): self
    {
        $this->matiere = $matiere;

        return $this;
    }

}
