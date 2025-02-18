<?php

namespace App\Entity;

use App\Repository\RendezVousRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RendezVousRepository::class)]
class RendezVous
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le nom du patient ne peut pas être vide.")]
     #[Assert\Length(
       min: 2,
       max: 255,
       minMessage: "Le nom du patient doit contenir au moins {{ limit }} caractères.",
       maxMessage: "Le nom du patient ne peut pas dépasser {{ limit }} caractères."
    )]
    private ?string $NomPatient = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le nom du médecin ne peut pas être vide.")]
 #[Assert\Length(
                       min: 2,
                       max: 255,
                       minMessage: "Le nom du médecin doit contenir au moins {{ limit }} caractères.",
                       maxMessage: "Le nom du médecin ne peut pas dépasser {{ limit }} caractères."
                   )]
    private ?string $NomMedecin = null;

    #[ORM\Column(type: Types::DATE_MUTABLE , nullable: true)]
    #[Assert\NotBlank(message: "La date du rendez-vous ne peut pas être vide.")]
     #[Assert\Type("\DateTimeInterface", message: "La date du rendez-vous doit être une date valide.")]
    private ?\DateTimeInterface $Date;

    #[ORM\Column(type: Types::TIME_MUTABLE , nullable: true)]
    #[Assert\NotBlank(message: "L'heure du rendez-vous ne peut pas être vide.")]
     #[Assert\Type("\DateTimeInterface", message: "L'heure du rendez-vous doit être une heure valide.")]
    private ?\DateTimeInterface $Heure ;

    #[ORM\Column(length: 255)]
    private ?string $Statut = null;

    #[ORM\Column(type: Types::TEXT , nullable: true)]

    #[Assert\Length(
        max: 1000,
        maxMessage: "La description ne peut pas dépasser {{ limit }} caractères."
    )]
    private ?string $Description = null;

    #[ORM\ManyToOne(inversedBy: 'rendezVouses')]
    private ?User $relation = null;

    #[ORM\ManyToOne(inversedBy: 'rendezVouses')]
    private ?User $RelationMedecin = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPatient(): ?string
    {
        return $this->NomPatient;
    }

    public function setNomPatient(?string $NomPatient): static
    {
        $this->NomPatient = $NomPatient;

        return $this;
    }

    public function getNomMedecin(): ?string
    {
        return $this->NomMedecin;
    }

    public function setNomMedecin(string $NomMedecin): static
    {
        $this->NomMedecin = $NomMedecin;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(?\DateTimeInterface $Date): static
    {
        if ($Date !== null) {
              $this->Date = $Date;
        }
        return $this;
    }

    public function getHeure(): ?\DateTimeInterface
    {
        return $this->Heure;
    }

    public function setHeure(\DateTimeInterface $Heure): static
    {
        $this->Heure = $Heure;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->Statut;
    }

    public function setStatut(string $Statut): static
    {
        $this->Statut = $Statut;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }


    public function __construct()
    {
         $this->Date = new \DateTime();
         $this->Heure = new \DateTime();
    }

    public function getRelation(): ?User
    {
        return $this->relation;
    }

    public function setRelation(?User $relation): static
    {
        $this->relation = $relation;

        return $this;
    }

    public function getRelationMedecin(): ?User
    {
        return $this->RelationMedecin;
    }

    public function setRelationMedecin(?User $RelationMedecin): static
    {
        $this->RelationMedecin = $RelationMedecin;

        return $this;
    }

}
