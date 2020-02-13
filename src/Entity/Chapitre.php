<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChapitreRepository")
 */
class Chapitre
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
     * @ORM\Column(type="string", length=255)
     */
    private $contenu;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Partie", inversedBy="chapitres")
     */
    private $partie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Lecon", mappedBy="chapitre")
     */
    private $lecons;
    


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

    public function setPartie(Partie $partie): self
    {
        $this->partie = $partie;
        return $this;
    }

    public function getPartie(): ?Partie
    {
        return $this->partie;
    }


    /**
     * @return Collection\Lecon[]
     */
    public function getLecon(): Collection
    {
        return $this->lecons;
    }

    public function removeLecon(Lecon $lecon) :self
    {
        if($this->lecons->contains($lecon))
        {
            $this->lecons->removeLecon($lecon);
            if($lecon->getChapitre() === $this)
        {
            $lecon->setChapitre(null);
        } 
        }

        return $this;
    }

    public function __toString()
    {
        return $this->titre;
    }
}
