<?php

namespace App\Entity;

use App\Repository\PhotoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PhotoRepository::class)]
class Photo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTime $datePriseVue = null;

    #[ORM\Column(length: 255)]
    private ?string $nomFichier = null;

    #[ORM\Column(length: 100)]
    private ?string $etatOeuvre = null;

    #[ORM\ManyToOne(inversedBy: 'Photo')]
    private ?Oeuvre $Oeuvre = null;

    #[ORM\ManyToOne(inversedBy: 'Photo')]
    private ?Benevole $Benevole = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatePriseVue(): ?\DateTime
    {
        return $this->datePriseVue;
    }

    public function setDatePriseVue(\DateTime $datePriseVue): static
    {
        $this->datePriseVue = $datePriseVue;

        return $this;
    }

    public function getNomFichier(): ?string
    {
        return $this->nomFichier;
    }

    public function setNomFichier(string $nomFichier): static
    {
        $this->nomFichier = $nomFichier;

        return $this;
    }

    public function getEtatOeuvre(): ?string
    {
        return $this->etatOeuvre;
    }

    public function setEtatOeuvre(string $etatOeuvre): static
    {
        $this->etatOeuvre = $etatOeuvre;

        return $this;
    }

    public function getOeuvre(): ?Oeuvre
    {
        return $this->Oeuvre;
    }

    public function setOeuvre(?Oeuvre $Oeuvre): static
    {
        $this->Oeuvre = $Oeuvre;

        return $this;
    }

    public function getBenevole(): ?Benevole
    {
        return $this->Benevole;
    }

    public function setBenevole(?Benevole $Benevole): static
    {
        $this->Benevole = $Benevole;

        return $this;
    }
}
