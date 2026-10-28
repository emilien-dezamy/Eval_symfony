<?php

namespace App\Entity;

use App\Repository\TechniqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TechniqueRepository::class)]
class Technique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    /**
     * @var Collection<int, Oeuvre>
     */
    #[ORM\ManyToMany(targetEntity: Oeuvre::class, mappedBy: 'Technique')]
    private Collection $Oeuvre;

    public function __construct()
    {
        $this->Oeuvre = new ArrayCollection();
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
            $oeuvre->addTechnique($this);
        }

        return $this;
    }

    public function removeOeuvre(Oeuvre $oeuvre): static
    {
        if ($this->Oeuvre->removeElement($oeuvre)) {
            $oeuvre->removeTechnique($this);
        }

        return $this;
    }
}
