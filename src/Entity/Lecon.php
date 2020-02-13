<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\LeconRepository")
 */
class Lecon
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
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Format", inversedBy="lecons")
     * @Assert\NotBlank()
     */
    private $format;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Chapitre", inversedBy="lecons")
     */
    private $chapitre;


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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function setFormat(Format $format): self
    {
        $this->format = $format;
        return $this;
    }

    public function getFormat(): ?Format
    {
        return $this->format;
    }

    public function setChapitre(Chapitre $chapitre): self
    {
        $this->chapitre = $chapitre;
        return $this;
    }

    public function getchapitre(): ?Chapitre
    {
        return $this->chapitre;
    }

    public function __toString()
    {
        return $this->titre;
    }
}
