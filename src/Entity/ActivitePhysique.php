<?php

namespace App\Entity;

use App\Repository\ActivitePhysiqueRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActivitePhysiqueRepository::class)]
class ActivitePhysique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = '';

    #[ORM\Column]
    private ?int $duree = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = 'Aucune description disponible';

    #[ORM\Column(length: 255)]
    private ?string $intensite = null;

    // Nouvelle propriété maladie (vous l'avez déjà ajoutée)
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $maladie = null;

    // Traitements spécifiques pour certaines maladies
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $traitementDiabete = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $traitementHypertension = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $traitementMaladieChronique = null;
// src/Entity/ActivitePhysique.php

#[ORM\Column(length: 255, nullable: true)]
private ?string $salle = null;


public function getSalle(): ?string
{
    return $this->salle;
}

public function setSalle(?string $salle): self
{
    $this->salle = $salle;

    return $this;
}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): static
    {
        $this->duree = $duree;

        return $this;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getIntensite(): ?string
    {
        return $this->intensite;
    }

    public function setIntensite(string $intensite): static
    {
        $this->intensite = $intensite;

        return $this;
    }

    // Méthodes pour la propriété maladie
    public function getMaladie(): ?string
    {
        return $this->maladie;
    }

    public function setMaladie(?string $maladie): self
    {
        $this->maladie = $maladie;

        return $this;
    }

    // Méthodes pour les traitements spécifiques
    public function getTraitementDiabete(): ?string
    {
        return $this->traitementDiabete;
    }

    public function setTraitementDiabete(?string $traitementDiabete): self
    {
        $this->traitementDiabete = $traitementDiabete;

        return $this;
    }

    public function getTraitementHypertension(): ?string
    {
        return $this->traitementHypertension;
    }

    public function setTraitementHypertension(?string $traitementHypertension): self
    {
        $this->traitementHypertension = $traitementHypertension;

        return $this;
    }

    public function getTraitementMaladieChronique(): ?string
    {
        return $this->traitementMaladieChronique;
    }

    public function setTraitementMaladieChronique(?string $traitementMaladieChronique): self
    {
        $this->traitementMaladieChronique = $traitementMaladieChronique;

        return $this;
    }

    
}
