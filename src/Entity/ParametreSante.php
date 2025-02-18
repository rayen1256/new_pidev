<?php

namespace App\Entity;

use App\Repository\ParametreSanteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParametreSanteRepository::class)]
class ParametreSante
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateMesure = null;

    #[ORM\Column]
    private ?float $valeur = null;

    #[ORM\Column]
    private ?int $note = null;

    #[ORM\Column(length: 255)]
    private ?string $typeparametre = null;

    #[ORM\ManyToOne(inversedBy: 'parametreSantes')]
    private ?DossierMedical $dossier_med = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateMesure(): ?\DateTimeInterface
    {
        return $this->dateMesure;
    }

    public function setDateMesure(\DateTimeInterface $dateMesure): static
    {
        $this->dateMesure = $dateMesure;

        return $this;
    }

    public function getValeur(): ?float
    {
        return $this->valeur;
    }

    public function setValeur(float $valeur): static
    {
        $this->valeur = $valeur;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getTypeparametre(): ?string
    {
        return $this->typeparametre;
    }

    public function setTypeparametre(string $typeparametre): static
    {
        $this->typeparametre = $typeparametre;

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
