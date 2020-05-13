<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserOptionRepository")
 */
class UserOption
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Apprenant", inversedBy="specialite", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $apprenant;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Specialite", inversedBy="userOption", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $specialite;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Matiere", inversedBy="userOption", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $matiere;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Partie", inversedBy="userOption", cascade={"persist", "remove"})
     */
    private $partie;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Chapitre", inversedBy="userOption", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $chapitre;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Lecon", inversedBy="userOption", cascade={"persist", "remove"})
     */
    private $lecon;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getApprenant(): ?Apprenant
    {
        return $this->apprenant;
    }

    public function setApprenant(Apprenant $apprenant): self
    {
        $this->apprenant = $apprenant;

        return $this;
    }

    public function getSpecialite(): ?Specialite
    {
        return $this->specialite;
    }

    public function setSpecialite(Specialite $specialite): self
    {
        $this->specialite = $specialite;

        return $this;
    }

    public function getMatiere(): ?Matiere
    {
        return $this->matiere;
    }

    public function setMatiere(Matiere $matiere): self
    {
        $this->matiere = $matiere;

        return $this;
    }

    public function getPartie(): ?Partie
    {
        return $this->partie;
    }

    public function setPartie(?Partie $partie): self
    {
        $this->partie = $partie;

        return $this;
    }

    public function getChapitre(): ?Chapitre
    {
        return $this->chapitre;
    }

    public function setChapitre(Chapitre $chapitre): self
    {
        $this->chapitre = $chapitre;

        return $this;
    }

    public function getLecon(): ?Lecon
    {
        return $this->lecon;
    }

    public function setLecon(?Lecon $lecon): self
    {
        $this->lecon = $lecon;

        return $this;
    }
}
