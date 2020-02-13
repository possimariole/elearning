<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FormatRepository")
 */
class Format
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Lecon", mappedBy="format")
     */
    private $lecons;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
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
            $this->lecons->removeElement($lecon);
            if($lecon->getFormat() === $this)
        {
            $lecon->setFormat(null);
        } 
        }

        return $this;
    }

    public function __toString()
    {
        return $this->type;
    }

}
