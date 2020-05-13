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
     * @ORM\OneToMany(targetEntity="App\Entity\Partie", mappedBy="chapitre", cascade={"persist", "remove"})
     */
    private $parties;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Lecon", mappedBy="chapitre")
     */
    private $lecons;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="chapitres")
     */
    private $createdBy;

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
     * @ORM\OneToOne(targetEntity="App\Entity\UserOption", mappedBy="chapitre", cascade={"persist", "remove"})
     */
    private $userOption;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->is_active = true;
        $this->is_delete = false;
        $this->lecons = new ArrayCollection();
        $this->parties = new ArrayCollection();
    }

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

    public function __toString()
    {
        return $this->titre;
    }

    /**
     * @return Collection|Lecon[]
     */
    public function getLecons(): Collection
    {
        return $this->lecons;
    }

    public function addLecon(Lecon $lecon): self
    {
        if (!$this->lecons->contains($lecon)) {
            $this->lecons[] = $lecon;
            $lecon->setChapitre($this);
        }

        return $this;
    }

    public function removeLecon(Lecon $lecon): self
    {
        if ($this->lecons->contains($lecon)) {
            $this->lecons->removeElement($lecon);
            // set the owning side to null (unless already changed)
            if ($lecon->getChapitre() === $this) {
                $lecon->setChapitre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Partie[]
     */
    public function getParties(): Collection
    {
        return $this->parties;
    }

    public function addParty(Partie $party): self
    {
        if (!$this->parties->contains($party)) {
            $this->parties[] = $party;
            $party->setChapitre($this);
        }

        return $this;
    }

    public function removeParty(Partie $party): self
    {
        if ($this->parties->contains($party)) {
            $this->parties->removeElement($party);
            // set the owning side to null (unless already changed)
            if ($party->getChapitre() === $this) {
                $party->setChapitre(null);
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

    public function getUserOption(): ?UserOption
    {
        return $this->userOption;
    }

    public function setUserOption(UserOption $userOption): self
    {
        $this->userOption = $userOption;

        // set the owning side of the relation if necessary
        if ($userOption->getChapitre() !== $this) {
            $userOption->setChapitre($this);
        }

        return $this;
    }
}
