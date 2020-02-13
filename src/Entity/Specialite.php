<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\SpecialiteRepository")
 */
class Specialite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    private $nom;

    /**
     * @ORM\Column(type="float")
     * @Assert\Type("float")
     */
    private $frais;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Matiere")
     */
    private $matieres;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Formation", inversedBy="specialites")
     */
    private $formation;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Inscription", mappedBy="specialite")
     */
    private $inscriptions;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getFrais(): ?float
    {
        return $this->frais;
    }

    public function setFrais(float $frais): self
    {
        $this->frais = $frais;

        return $this;
    }

    public function __construct()
    {
        $this->matieres = new arraycollection();
    }

    public function addMatiere(Matiere $matiere)
    {
        $this->matieres[] = $matiere;
        return $this;
    }

    public function removeNote(Matiere $matiere)
    {
        $this->matieres->removeElement($matiere);
    }
    
    public function getMatieres()
    {
        return $this->matieres;
    }

    public function setFormation(Formation $formation): self
    {
        $this->formation = $formation;
        return $this;
    }

    public function getFormation(): ?Formation
    {
        return $this->formation;
    }

    public function addInscription(Inscription $inscription)
    {
        if(!$this->inscriptions->contains($inscription))
        {
            $this->inscriptions[] = $inscription;
            $inscription->setSpecialite($this);
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
            if($inscription->getSpecialite() === $this); 
            {
                $inscription->setSpecialite(null);
            }
        }
        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }
}
