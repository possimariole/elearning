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
     * @ORM\Column(type="date")
     * Assert\date
     * @var string A "y-m-d"formatted values
     */
    private $debut;

    /**
     * @ORM\Column(type="date")
     * Assert\date
     * @var string A "y-m-d"formatted values
     */
    private $fin;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Inscription", mappedBy="anneeAcademique")
     * 
     */
    private $inscriptions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Dispenser", mappedBy="anneeAcademique")
     * 
     */
    private $dispensers;

    /**
     * @ORM\Column(type="boolean", options={"default":true})
     */
    private $is_active;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $is_delete;

    /**
     * @ORM\Column(type="date")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="date")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="anneeacademiques")
     */
    private $createdBy;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->is_active = true;
        $this->is_delete = false;
        $this->inscriptions = new ArrayCollection();
        $this->dispensers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function __toString()
    {
        return (string)$this->debut;
    }

    /**
     * @return Collection|Inscription[]
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function removeInscription(Inscription $inscription): self
    {
        if ($this->inscriptions->contains($inscription)) {
            $this->inscriptions->removeElement($inscription);
            // set the owning side to null (unless already changed)
            if ($inscription->getAnneeAcademique() === $this) {
                $inscription->setAnneeAcademique(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Dispenser[]
     */
    public function getDispensers(): Collection
    {
        return $this->dispensers;
    }

    public function addDispenser(Dispenser $dispenser): self
    {
        if (!$this->dispensers->contains($dispenser)) {
            $this->dispensers[] = $dispenser;
            $dispenser->setAnneeAcademique($this);
        }

        return $this;
    }

    public function removeDispenser(Dispenser $dispenser): self
    {
        if ($this->dispensers->contains($dispenser)) {
            $this->dispensers->removeElement($dispenser);
            // set the owning side to null (unless already changed)
            if ($dispenser->getAnneeAcademique() === $this) {
                $dispenser->setAnneeAcademique(null);
            }
        }

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }

    public function getIsDelete(): ?bool
    {
        return $this->is_delete;
    }

    public function setIsDelete(bool $is_delete): self
    {
        $this->is_delete = $is_delete;

        return $this;
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }
}
