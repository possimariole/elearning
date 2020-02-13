<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ModePaiementRepository")
 */
class ModePaiement
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
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Paiement", mappedBy="modePaiement")
     */
    private $paiements;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection\Paiement[]
     */
    public function getPaiement(): Collection
    {
        return $this->paiements;
    }

    public function removePaiement(Paiement $paiement) :self
    {
        if($this->paiements->contains($paiement))
        {
            $this->paiements->removeElement($paiement);
            if($paiement->getModePaiement() === $this)
        {
            $paiement->setModePaiement(null);
        } 
        }

        return $this;
    }

    public function __toString()
    {
        return $this->libelle;
    }

}
