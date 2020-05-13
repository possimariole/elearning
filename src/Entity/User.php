<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $activation_token;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Inscription", cascade={"persist", "remove"})
     */
    private $inscription;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Enseignant", cascade={"persist", "remove"})
     */
    private $enseignant;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Chapitre", mappedBy="createdBy")
     */
    private $chapitres;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Formation", mappedBy="createdBy")
     */
    private $formations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Inscription", mappedBy="createdBy")
     */
    private $inscriptions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Matiere", mappedBy="createdBy")
     */
    private $matieres;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Lecon", mappedBy="createdBy")
     */
    private $lecons;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Niveau", mappedBy="createdBy")
     */
    private $niveaux;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Diplome", mappedBy="createdBy")
     */
    private $diplomes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ModePaiement", mappedBy="createdBy")
     */
    private $modepaiements;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Dispenser", mappedBy="createdBy")
     */
    private $dispensers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Note", mappedBy="createdBy")
     */
    private $notes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Paiement", mappedBy="createdBy")
     */
    private $paiements;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Partie", mappedBy="createdBy")
     */
    private $parties;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Specialite", mappedBy="createdBy")
     */
    private $specialites;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AnneeAcademique", mappedBy="createdBy")
     */
    private $anneeacademiques;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Format", mappedBy="createdBy")
     */
    private $formats;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Apprenant", mappedBy="createdBy")
     */
    private $apprenants;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Enseignant", mappedBy="createdBy")
     */
    private $enseignants;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Adresse", mappedBy="createdBy")
     */
    private $adresses;

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

    public function __construct()
    {
        $this->chapitres = new ArrayCollection();
        $this->formations = new ArrayCollection();
        $this->inscriptions = new ArrayCollection();
        $this->matieres = new ArrayCollection();
        $this->lecons = new ArrayCollection();
        $this->niveaux = new ArrayCollection();
        $this->diplomes = new ArrayCollection();
        $this->modepaiements = new ArrayCollection();
        $this->dispensers = new ArrayCollection();
        $this->notes = new ArrayCollection();
        $this->paiements = new ArrayCollection();
        $this->parties = new ArrayCollection();
        $this->specialites = new ArrayCollection();
        $this->anneeacademiques = new ArrayCollection();
        $this->formats = new ArrayCollection();
        $this->apprenants = new ArrayCollection();
        $this->enseignants = new ArrayCollection();
        $this->adresses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getActivationToken(): ?string
    {
        return $this->activation_token;
    }

    public function setActivationToken(?string $activation_token): self
    {
        $this->activation_token = $activation_token;

        return $this;
    }

    public function getEnseignant(): ?Enseignant
    {
        return $this->enseignant;
    }

    public function setEnseignant(?Enseignant $enseignant): self
    {
        $this->enseignant = $enseignant;

        return $this;
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

    /**
     * @return Collection|Chapitre[]
     */
    public function getChapitres(): Collection
    {
        return $this->chapitres;
    }

    public function addChapitre(Chapitre $chapitre): self
    {
        if (!$this->chapitres->contains($chapitre)) {
            $this->chapitres[] = $chapitre;
            $chapitre->setCreatedBy($this);
        }

        return $this;
    }

    public function removeChapitre(Chapitre $chapitre): self
    {
        if ($this->chapitres->contains($chapitre)) {
            $this->chapitres->removeElement($chapitre);
            // set the owning side to null (unless already changed)
            if ($chapitre->getCreatedBy() === $this) {
                $chapitre->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Formation[]
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    public function addFormation(Formation $formation): self
    {
        if (!$this->formations->contains($formation)) {
            $this->formations[] = $formation;
            $formation->setCreatedBy($this);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): self
    {
        if ($this->formations->contains($formation)) {
            $this->formations->removeElement($formation);
            // set the owning side to null (unless already changed)
            if ($formation->getCreatedBy() === $this) {
                $formation->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Inscription[]
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): self
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions[] = $inscription;
            $inscription->setCreatedBy($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): self
    {
        if ($this->inscriptions->contains($inscription)) {
            $this->inscriptions->removeElement($inscription);
            // set the owning side to null (unless already changed)
            if ($inscription->getCreatedBy() === $this) {
                $inscription->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Matiere[]
     */
    public function getMatieres(): Collection
    {
        return $this->matieres;
    }

    public function addMatiere(Matiere $matiere): self
    {
        if (!$this->matieres->contains($matiere)) {
            $this->matieres[] = $matiere;
            $matiere->setCreatedBy($this);
        }

        return $this;
    }

    public function removeMatiere(Matiere $matiere): self
    {
        if ($this->matieres->contains($matiere)) {
            $this->matieres->removeElement($matiere);
            // set the owning side to null (unless already changed)
            if ($matiere->getCreatedBy() === $this) {
                $matiere->setCreatedBy(null);
            }
        }

        return $this;
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
            $lecon->setCreatedBy($this);
        }

        return $this;
    }

    public function removeLecon(Lecon $lecon): self
    {
        if ($this->lecons->contains($lecon)) {
            $this->lecons->removeElement($lecon);
            // set the owning side to null (unless already changed)
            if ($lecon->getCreatedBy() === $this) {
                $lecon->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Niveau[]
     */
    public function getNiveaux(): Collection
    {
        return $this->niveaux;
    }

    public function addNiveau(Niveau $niveau): self
    {
        if (!$this->niveaux->contains($niveau)) {
            $this->niveaux[] = $niveau;
            $niveau->setCreatedBy($this);
        }

        return $this;
    }

    public function removeNiveau(Niveau $niveau): self
    {
        if ($this->niveaux->contains($niveau)) {
            $this->niveaux->removeElement($niveau);
            // set the owning side to null (unless already changed)
            if ($niveau->getCreatedBy() === $this) {
                $niveau->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Diplome[]
     */
    public function getDiplomes(): Collection
    {
        return $this->diplomes;
    }

    public function addDiplome(Diplome $diplome): self
    {
        if (!$this->diplomes->contains($diplome)) {
            $this->diplomes[] = $diplome;
            $diplome->setCreatedBy($this);
        }

        return $this;
    }

    public function removeDiplome(Diplome $diplome): self
    {
        if ($this->diplomes->contains($diplome)) {
            $this->diplomes->removeElement($diplome);
            // set the owning side to null (unless already changed)
            if ($diplome->getCreatedBy() === $this) {
                $diplome->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ModePaiement[]
     */
    public function getModepaiements(): Collection
    {
        return $this->modepaiements;
    }

    public function addModepaiement(ModePaiement $modepaiement): self
    {
        if (!$this->modepaiements->contains($modepaiement)) {
            $this->modepaiements[] = $modepaiement;
            $modepaiement->setCreatedBy($this);
        }

        return $this;
    }

    public function removeModepaiement(ModePaiement $modepaiement): self
    {
        if ($this->modepaiements->contains($modepaiement)) {
            $this->modepaiements->removeElement($modepaiement);
            // set the owning side to null (unless already changed)
            if ($modepaiement->getCreatedBy() === $this) {
                $modepaiement->setCreatedBy(null);
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
            $dispenser->setCreatedBy($this);
        }

        return $this;
    }

    public function removeDispenser(Dispenser $dispenser): self
    {
        if ($this->dispensers->contains($dispenser)) {
            $this->dispensers->removeElement($dispenser);
            // set the owning side to null (unless already changed)
            if ($dispenser->getCreatedBy() === $this) {
                $dispenser->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Note[]
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Note $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes[] = $note;
            $note->setCreatedBy($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->contains($note)) {
            $this->notes->removeElement($note);
            // set the owning side to null (unless already changed)
            if ($note->getCreatedBy() === $this) {
                $note->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Paiement[]
     */
    public function getPaiements(): Collection
    {
        return $this->paiements;
    }

    public function addPaiement(Paiement $paiement): self
    {
        if (!$this->paiements->contains($paiement)) {
            $this->paiements[] = $paiement;
            $paiement->setCreatedBy($this);
        }

        return $this;
    }

    public function removePaiement(Paiement $paiement): self
    {
        if ($this->paiements->contains($paiement)) {
            $this->paiements->removeElement($paiement);
            // set the owning side to null (unless already changed)
            if ($paiement->getCreatedBy() === $this) {
                $paiement->setCreatedBy(null);
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
            $party->setCreatedBy($this);
        }

        return $this;
    }

    public function removeParty(Partie $party): self
    {
        if ($this->parties->contains($party)) {
            $this->parties->removeElement($party);
            // set the owning side to null (unless already changed)
            if ($party->getCreatedBy() === $this) {
                $party->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Specialite[]
     */
    public function getSpecialites(): Collection
    {
        return $this->specialites;
    }

    public function addSpecialite(Specialite $specialite): self
    {
        if (!$this->specialites->contains($specialite)) {
            $this->specialites[] = $specialite;
            $specialite->setCreatedBy($this);
        }

        return $this;
    }

    public function removeSpecialite(Specialite $specialite): self
    {
        if ($this->specialites->contains($specialite)) {
            $this->specialites->removeElement($specialite);
            // set the owning side to null (unless already changed)
            if ($specialite->getCreatedBy() === $this) {
                $specialite->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AnneeAcademique[]
     */
    public function getAnneeacademiques(): Collection
    {
        return $this->anneeacademiques;
    }

    public function addAnneeacademique(AnneeAcademique $anneeacademique): self
    {
        if (!$this->anneeacademiques->contains($anneeacademique)) {
            $this->anneeacademiques[] = $anneeacademique;
            $anneeacademique->setCreatedBy($this);
        }

        return $this;
    }

    public function removeAnneeacademique(AnneeAcademique $anneeacademique): self
    {
        if ($this->anneeacademiques->contains($anneeacademique)) {
            $this->anneeacademiques->removeElement($anneeacademique);
            // set the owning side to null (unless already changed)
            if ($anneeacademique->getCreatedBy() === $this) {
                $anneeacademique->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Format[]
     */
    public function getFormats(): Collection
    {
        return $this->formats;
    }

    public function addFormat(Format $format): self
    {
        if (!$this->formats->contains($format)) {
            $this->formats[] = $format;
            $format->setCreatedBy($this);
        }

        return $this;
    }

    public function removeFormat(Format $format): self
    {
        if ($this->formats->contains($format)) {
            $this->formats->removeElement($format);
            // set the owning side to null (unless already changed)
            if ($format->getCreatedBy() === $this) {
                $format->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Apprenant[]
     */
    public function getApprenants(): Collection
    {
        return $this->apprenants;
    }

    public function addApprenant(Apprenant $apprenant): self
    {
        if (!$this->apprenants->contains($apprenant)) {
            $this->apprenants[] = $apprenant;
            $apprenant->setCreatedBy($this);
        }

        return $this;
    }

    public function removeApprenant(Apprenant $apprenant): self
    {
        if ($this->apprenants->contains($apprenant)) {
            $this->apprenants->removeElement($apprenant);
            // set the owning side to null (unless already changed)
            if ($apprenant->getCreatedBy() === $this) {
                $apprenant->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Enseignant[]
     */
    public function getEnseignants(): Collection
    {
        return $this->enseignants;
    }

    public function addEnseignant(Enseignant $enseignant): self
    {
        if (!$this->enseignants->contains($enseignant)) {
            $this->enseignants[] = $enseignant;
            $enseignant->setCreatedBy($this);
        }

        return $this;
    }

    public function removeEnseignant(Enseignant $enseignant): self
    {
        if ($this->enseignants->contains($enseignant)) {
            $this->enseignants->removeElement($enseignant);
            // set the owning side to null (unless already changed)
            if ($enseignant->getCreatedBy() === $this) {
                $enseignant->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Adresse[]
     */
    public function getAdresses(): Collection
    {
        return $this->adresses;
    }

    public function addAdress(Adresse $adress): self
    {
        if (!$this->adresses->contains($adress)) {
            $this->adresses[] = $adress;
            $adress->setCreatedBy($this);
        }

        return $this;
    }

    public function removeAdress(Adresse $adress): self
    {
        if ($this->adresses->contains($adress)) {
            $this->adresses->removeElement($adress);
            // set the owning side to null (unless already changed)
            if ($adress->getCreatedBy() === $this) {
                $adress->setCreatedBy(null);
            }
        }

        return $this;
    }
}
