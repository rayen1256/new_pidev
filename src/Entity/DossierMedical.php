<?php

namespace App\Entity;

use App\Repository\DossierMedicalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DossierMedicalRepository::class)]
class DossierMedical
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le type de maladie est obligatoire.")]
    private ?string $typemaladie = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message: "La date de création est obligatoire.")]
    #[Assert\Type("\DateTimeInterface", message: "La date de création doit être une date valide.")]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "La description est obligatoire.")]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message: "La date du dernier suivi est obligatoire.")]
    #[Assert\Type("\DateTimeInterface", message: "La date du dernier suivi doit être une date valide.")]
    private ?\DateTimeInterface $dernierSuivi = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[Assert\NotBlank(message: "L'utilisateur est obligatoire.")]
    private ?User $id_user = null;

    /**
     * @var Collection<int, DocumentMedical>
     */
    #[ORM\OneToMany(targetEntity: DocumentMedical::class, mappedBy: 'dossier_med')]
    private Collection $documentMedicals;

    /**
     * @var Collection<int, ParametreSante>
     */
    #[ORM\OneToMany(targetEntity: ParametreSante::class, mappedBy: 'dossier_med')]
    private Collection $parametreSantes;

    /**
     * @var Collection<int, TraitementMedical>
     */
    #[ORM\OneToMany(targetEntity: TraitementMedical::class, mappedBy: 'dossier_med')]
    private Collection $traitementMedicals;

    public function __construct()
    {
        $this->dateCreation = new \DateTime();
        $this->dernierSuivi = new \DateTime();  // Définit la date actuelle par défaut
    $this->documentMedicals = new ArrayCollection();
    $this->parametreSantes = new ArrayCollection();
    $this->traitementMedicals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypemaladie(): ?string
    {
        return $this->typemaladie;
    }

    public function setTypemaladie(string $typemaladie): static
    {
        $this->typemaladie = $typemaladie;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDernierSuivi(): ?\DateTimeInterface
    {
        return $this->dernierSuivi;
    }

    public function setDernierSuivi(\DateTimeInterface $dernierSuivi): static
    {
        $this->dernierSuivi = $dernierSuivi;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->id_user;
    }

    public function setIdUser(?User $id_user): static
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * @return Collection<int, DocumentMedical>
     */
    public function getDocumentMedicals(): Collection
    {
        return $this->documentMedicals;
    }

    public function addDocumentMedical(DocumentMedical $documentMedical): static
    {
        if (!$this->documentMedicals->contains($documentMedical)) {
            $this->documentMedicals->add($documentMedical);
            $documentMedical->setDossierMed($this);
        }

        return $this;
    }

    public function removeDocumentMedical(DocumentMedical $documentMedical): static
    {
        if ($this->documentMedicals->removeElement($documentMedical)) {
            // set the owning side to null (unless already changed)
            if ($documentMedical->getDossierMed() === $this) {
                $documentMedical->setDossierMed(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ParametreSante>
     */
    public function getParametreSantes(): Collection
    {
        return $this->parametreSantes;
    }

    public function addParametreSante(ParametreSante $parametreSante): static
    {
        if (!$this->parametreSantes->contains($parametreSante)) {
            $this->parametreSantes->add($parametreSante);
            $parametreSante->setDossierMed($this);
        }

        return $this;
    }

    public function removeParametreSante(ParametreSante $parametreSante): static
    {
        if ($this->parametreSantes->removeElement($parametreSante)) {
            // set the owning side to null (unless already changed)
            if ($parametreSante->getDossierMed() === $this) {
                $parametreSante->setDossierMed(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TraitementMedical>
     */
    public function getTraitementMedicals(): Collection
    {
        return $this->traitementMedicals;
    }

    public function addTraitementMedical(TraitementMedical $traitementMedical): static
    {
        if (!$this->traitementMedicals->contains($traitementMedical)) {
            $this->traitementMedicals->add($traitementMedical);
            $traitementMedical->setDossierMed($this);
        }

        return $this;
    }

    public function removeTraitementMedical(TraitementMedical $traitementMedical): static
    {
        if ($this->traitementMedicals->removeElement($traitementMedical)) {
            // set the owning side to null (unless already changed)
            if ($traitementMedical->getDossierMed() === $this) {
                $traitementMedical->setDossierMed(null);
            }
        }

        return $this;
    }
}
