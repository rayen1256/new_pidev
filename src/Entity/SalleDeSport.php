<?php

namespace App\Entity;

use App\Repository\SalleDeSportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SalleDeSportRepository::class)]
class SalleDeSport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $equipements = [];

    #[ORM\Column(length: 255)]
    private ?string $horaires = null;

    #[ORM\Column]
    private ?int $capacite = null;

    /**
     * @var Collection<int, ActivitePhysique>
     */
    #[ORM\ManyToMany(targetEntity: ActivitePhysique::class)]
    private Collection $Excister;

    public function __construct()
    {
        $this->Excister = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getEquipements(): array
    {
        return $this->equipements;
    }

    public function setEquipements(array $equipements): static
    {
        $this->equipements = $equipements;

        return $this;
    }

    public function getHoraires(): ?string
    {
        return $this->horaires;
    }

    public function setHoraires(string $horaires): static
    {
        $this->horaires = $horaires;

        return $this;
    }

    public function getCapacite(): ?int
    {
        return $this->capacite;
    }

    public function setCapacite(int $capacite): static
    {
        $this->capacite = $capacite;

        return $this;
    }

    /**
     * @return Collection<int, ActivitePhysique>
     */
    public function getExcister(): Collection
    {
        return $this->Excister;
    }

    public function addExcister(ActivitePhysique $excister): static
    {
        if (!$this->Excister->contains($excister)) {
            $this->Excister->add($excister);
        }

        return $this;
    }

    public function removeExcister(ActivitePhysique $excister): static
    {
        $this->Excister->removeElement($excister);

        return $this;
    }
}
