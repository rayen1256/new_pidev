<?php

namespace App\Entity;

use App\Repository\DocumentMedicalRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DocumentMedicalRepository::class)]
class DocumentMedical
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le type de document est obligatoire.")]
    #[Assert\Length(max: 255, maxMessage: "Le type ne doit pas dépasser 255 caractères.")]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le titre du document est obligatoire.")]
    #[Assert\Length(max: 255, maxMessage: "Le titre ne doit pas dépasser 255 caractères.")]
    private ?string $titre = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message: "La date d'upload est obligatoire.")]
    #[Assert\Type("\DateTimeInterface", message: "La date d'upload doit être une date valide.")]
    private ?\DateTimeInterface $dateUpload = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le fichier est obligatoire.")]
    #[Assert\Length(max: 255, maxMessage: "Le nom du fichier ne doit pas dépasser 255 caractères.")]
    private ?string $fichier = null;

    #[ORM\ManyToOne(inversedBy: 'documentMedicals')]
    #[Assert\NotNull(message: "Le dossier médical associé est obligatoire.")]
    private ?DossierMedical $dossier_med = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDateUpload(): ?\DateTimeInterface
    {
        return $this->dateUpload;
    }

    public function setDateUpload(\DateTimeInterface $dateUpload): static
    {
        $this->dateUpload = $dateUpload;

        return $this;
    }

    public function getFichier(): ?string
    {
        return $this->fichier;
    }

    public function setFichier(string $fichier): static
    {
        $this->fichier = $fichier;

        return $this;
    }

    public function getDossierMed(): ?DossierMedical
    {
        return $this->dossier_med;
    }

    public function setDossierMed(?DossierMedical $dossier_med): static
    {
        $this->dossier_med = $dossier_med;

        return $this;
    }
}
