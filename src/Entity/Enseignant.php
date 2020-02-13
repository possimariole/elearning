<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EnseignantRepository")
 */
class Enseignant
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="date")
     * Assert\Date
     * @var string A "Y-m-d" formatted value
     */
    private $dateNaiss;

    /**
     * @ORM\Column(type="string", length=255)
     * * @Assert\Country
     */
    private $pays;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $sexe;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $lieuNaissance;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Diplome", mappedBy="enseignant")
     */
    private $diplomes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Dispenser", mappedBy="enseignant")
     */
    private $dispensers;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Adresse", cascade={"persist", "remove"})
     * 
     * @ORM\JoinColumn(nullable=false)
     */
    private $adresse;

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaiss(): ?\DateTimeInterface
    {
        return $this->dateNaiss;
    }

    public function setDateNaiss(\DateTimeInterface $dateNaiss): self
    {
        $this->dateNaiss = $dateNaiss;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getLieuNaissance(): ?string
    {
        return $this->lieuNaissance;
    }

    public function setLieuNaissance(string $lieuNaissance): self
    {
        $this->lieuNaissance = $lieuNaissance;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function addDiplome(Diplome $diplome)
    {
        if(!$this->diplomes->contains($diplome))
        {
            $this->diplomes[] = $diplome;
            $diplome->setEnseignsnt($this);
        }
        return $this;
    }

    /**
     * @return collection\Diplomes[];
     */
    public function getDiplome(): Collection
    {
        return $this->diplomes;
    }

    public function removeElement(Diplome $diplome): self
    {
        if($this->diplomes->contains($diplome))
        {
            $this->diplomes->removeElement($diplome);
            if($diplome->getEnseignant() === $this); 
            {
                $diplome->setEnseignant(null);
            }
        }
        return $this;
    }

    public function addDispenser(Dispenser $dispenser)
    {
        if(!$this->dispensers->contains($dispenser))
        {
            $this->dispensers[] = $dispenser;
            $dispenser->setEnseignant($this);
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
            if($dispenser->getEnseignant() === $this)
            {
                $dispenser->setEnseignant(null);
            }
        }
              return $this;
    }
    
    public function __toString()
    {
        return $this->nom;
    }

}
