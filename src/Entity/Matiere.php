<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\MatiereRepository")
 */
class Matiere
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $code;

     /**
     * @ORM\OneToMany(targetEntity="App\Entity\Note", mappedBy="matiere")
     * @Assert\Length(min=1)
     * @Assert\Length(max=2)
     */
    private $notes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Dispenser", mappedBy="matiere")
     */
    private $dispensers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Partie", mappedBy="matiere")
     */
    private $parties;

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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return collection\Notes[]
     */
    public function getNote(): collection
    {
        return $this->notes;
    }

    public function removeElement(Note $note): self
    {
        if($this->notes->contains($note))
        {
            $this->notes->removeElement($note);
            if($note->getMatiere() === $this)
            {
                    $note->setMatiere(null);
            }
        }
        return $this;
    }

    public function addDispenser(Dispenser $dispenser)
    {
        if(!$this->dispensers->contains($dispenser))
        {
            $this->dispensers[] = $dispenser;
            $dispenser->setMatiere($this);
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
            if($dispenser->getMatiere() === $this)
            {
                $dispenser->setMatiere(null);
            }
        }
              return $this;
    }

    /**
     * @return collection\Parties[]
     */
    public function getPartie(): collection
    {
        return $this->parties;
    }

    public function removePartie(Partie $partie): self
    {
        if($this->parties->contains($partie))
        {
            $this->parties->removePartie($partie);
            if($partie->getMatiere() === $this)
            {
                    $partie->setMatiere(null);
            }
        }
        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }

}
