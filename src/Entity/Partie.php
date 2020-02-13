<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\PartieRepository")
 */
class Partie
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
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $contenu;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Matiere", inversedBy="parties")
     * @Assert\NotBlank()
     */
    private $Matiere;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Chapitre", mappedBy="partie")
     */
    private $chapitres;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function setMatiere(Matiere $matiere): self
    {
        $this->matiere = $matiere;
        return $this;
    }

    public function getMatiere(): ?Matiere
    {
        return $this->Matiere;
    }

    /**
     * @return Collection\Chapitre[]
     */
    public function getChapitre(): Collection
    {
        return $this->chapitres;
    }

    public function removeChapitre(Chapitre $chapitre) :self
    {
        if($this->chapitres->contains($chapitre))
        {
            $this->chapitres->removeChapitre($chapitre);
            if($chapitre->getPartie() === $this)
        {
            $chapitre->setPartie(null);
        } 
        }

        return $this;
    }

    public function __toString()
    {
        return $this->titre;
    }


}
