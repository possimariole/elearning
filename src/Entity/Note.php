<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\NoteRepository")
 */
class Note
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     * @Assert\Length(min=1)
     * @Assert\Length(max=3)
     */
    private $moyenne;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Inscription", inversedBy="notes")
     */
    private $inscription;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Matiere", inversedBy="notes")
     */
    private $matiere;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="notes")
     */
    private $createdBy;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->is_active = true;
        $this->is_delete = false;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMoyenne(): ?float
    {
        return $this->moyenne;
    }

    public function setMoyenne(float $moyenne): self
    {
        $this->moyenne = $moyenne;

        return $this;
    }

    public function __toString()
    {
        return (string)$this->moyenne;
    }

    public function getInscription(): ?Inscription
    {
        return $this->inscription;
    }

    public function setInscription(?Inscription $inscription): self
    {
        $this->inscription = $inscription;

        return $this;
    }

    public function getMatiere(): ?Matiere
    {
        return $this->matiere;
    }

    public function setMatiere(?Matiere $matiere): self
    {
        $this->matiere = $matiere;

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
}
