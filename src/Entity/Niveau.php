<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NiveauRepository")
 */
class Niveau
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
     * @ORM\OneToMany(targetEntity="App\Entity\Inscription", mappedBy="niveau")
     * @Assert\Type("float")
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

    public function addInscription(Inscription $inscription)
    {
        if(!$this->inscriptions->contains($inscription))
        {
            $this->inscriptions[] = $inscription;
            $inscription->setNiveau($this);
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
            if($inscription->getNiveau() === $this); 
            {
                $inscription->setNiveau(null);
            }
        }
        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }
}
