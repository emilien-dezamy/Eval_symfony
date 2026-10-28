<?php

namespace App\Entity;

use App\Repository\ArtisteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtisteRepository::class)]
class Artiste
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $pseudonyme = null;

    #[ORM\Column(length: 20)]
    private ?string $nomReel = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bio = null;

    #[ORM\Column(length: 50)]
    private ?string $nationalite = null;

    /**
     * @var Collection<int, Oeuvre>
     */
    #[ORM\ManyToMany(targetEntity: Oeuvre::class, inversedBy: 'Artiste')]
    private Collection $Oeuvre;

    public function __construct()
    {
        $this->Oeuvre = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudonyme(): ?string
    {
        return $this->pseudonyme;
    }

    public function setPseudonyme(string $pseudonyme): static
    {
        $this->pseudonyme = $pseudonyme;

        return $this;
    }

    public function getNomReel(): ?string
    {
        return $this->nomReel;
    }

    public function setNomReel(string $nomReel): static
    {
        $this->nomReel = $nomReel;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(?string $bio): static
    {
        $this->bio = $bio;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): static
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    /**
     * @return Collection<int, Oeuvre>
     */
    public function getOeuvre(): Collection
    {
        return $this->Oeuvre;
    }

    public function addOeuvre(Oeuvre $oeuvre): static
    {
        if (!$this->Oeuvre->contains($oeuvre)) {
            $this->Oeuvre->add($oeuvre);
        }

        return $this;
    }

    public function removeOeuvre(Oeuvre $oeuvre): static
    {
        $this->Oeuvre->removeElement($oeuvre);

        return $this;
    }
}
