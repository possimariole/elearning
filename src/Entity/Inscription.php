<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InscriptionRepository")
 */
class Inscription
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $somme;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Paiement", mappedBy="inscription")
     */
    private $paiements;
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Note", mappedBy="inscription")
     * @Assert\Length(min=1)
     * @Assert\Length(max=2)
     */
    private $notes; 
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AnneeAcademique", inversedBy="inscriptions")
     * Assert\date
     * @var string A "y-m-d"formatted values
     */
    private $anneeAcademique;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Niveau", inversedBy="inscriptions")
     * @Assert\NotBlank()
     */
    private $niveau;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Apprenant", inversedBy="inscriptions")
     * @Assert\NotBlank()
     */
    private $apprenant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Specialite", inversedBy="inscriptions")
     */
    private $specialite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSomme(): ?float
    {
        return $this->somme;
    }

    public function setSomme(float $somme): self
    {
        $this->somme = $somme;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function addPaiement(Paiement $paiement) :self
    {
        if(!$this->paiements->contains($paiement))
        {
            $this->paiements[] = $paiement;
            $paiement->setInscription($this);
        }
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
            if($paiement->getInscription() === $this)
        {
            $paiement->setInscription(null);
        } 
        }

        return $this;
    }

    public function addNote(Note $note): self
    {
        if(!$this->notes->contains($note))
        {
            $this->notes[] = $note;
            $note->setInscription($this);
        }
        return $this;
    }

    /**
     * @return collection\notes[]
     */
    public function getNote(): Collection
    {
        return $this->notes;
    }

    public function removeElement(Note $note): self 
    {
        if($this->notes->contains($note))
        {
            $this->notes->removeElement($note);
            if($note->getInscription() === $this)
            {
                $note->setInscription($this);
            }
        }
        return $this;
    }

    public function setAnneeAcademique(AnneeAcademique $anneeAcademique): self
    {
        $this->anneeAcademique = $anneeAcademique;
        return $this;
    }

    public function getAnneeAcademique(): ?AnneeAcademique
    {
        return $this->anneeAcademique;
    }

    public function setNiveau(Niveau $niveau): self
    {
        $this->niveau = $niveau;
        return $this;
    }

    public function getNiveau(): ?Niveau
    {
        return $this->niveau;
    }

    public function setApprenant(Apprenant $apprenant): self
    {
        $this->apprenant = $apprenant;
        return $this;
    }

    public function getApprenant(): ?Apprenant
    {
        return $this->apprenant;
    }

    public function setSpecialite(Specialite $specialite): self
    {
        $this->specialite = $specialite;
        return $this;
    }

    public function getSpecialite(): ?Specialite
    {
        return $this->specialite;
    }

    public function __toString()
    {
        return (string)$this->somme;
    }

    
}
