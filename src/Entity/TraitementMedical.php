<?php

namespace App\Entity;

use App\Repository\TraitementMedicalRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TraitementMedicalRepository::class)]
class TraitementMedical
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomMedicament = null;

    #[ORM\Column(length: 255)]
    private ?string $dosage = null;

    #[ORM\Column(length: 255)]
    private ?string $frequence = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\ManyToOne(inversedBy: 'traitementMedicals')]
    private ?DossierMedical $dossier_med = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMedicament(): ?string
    {
        return $this->nomMedicament;
    }

    public function setNomMedicament(string $nomMedicament): static
    {
        $this->nomMedicament = $nomMedicament;

        return $this;
    }

    public function getDosage(): ?string
    {
        return $this->dosage;
    }

    public function setDosage(string $dosage): static
    {
        $this->dosage = $dosage;

        return $this;
    }

    public function getFrequence(): ?string
    {
        return $this->frequence;
    }

    public function setFrequence(string $frequence): static
    {
        $this->frequence = $frequence;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): static
    {
        $this->dateFin = $dateFin;

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
