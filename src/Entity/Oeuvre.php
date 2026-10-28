<?php

namespace App\Entity;

use App\Repository\OeuvreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OeuvreRepository::class)]
class Oeuvre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateCreation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateDestruction = null;

    /**
     * @var Collection<int, Artiste>
     */
    #[ORM\ManyToMany(targetEntity: Artiste::class, mappedBy: 'Oeuvre')]
    private Collection $Artiste;

    #[ORM\ManyToOne(inversedBy: 'Oeuvre')]
    private ?Lieu $Lieu = null;

    /**
     * @var Collection<int, Technique>
     */
    #[ORM\ManyToMany(targetEntity: Technique::class, inversedBy: 'Oeuvre')]
    private Collection $Technique;

    #[ORM\OneToOne(targetEntity: self::class, cascade: ['persist', 'remove'])]
    private ?self $Oeuvre = null;

    /**
     * @var Collection<int, Photo>
     */
    #[ORM\OneToMany(targetEntity: Photo::class, mappedBy: 'Oeuvre')]
    private Collection $Photo;

    public function __construct()
    {
        $this->Artiste = new ArrayCollection();
        $this->Technique = new ArrayCollection();
        $this->Photo = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDateCreation(): ?\DateTime
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTime $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDateDestruction(): ?\DateTime
    {
        return $this->dateDestruction;
    }

    public function setDateDestruction(\DateTime $dateDestruction): static
    {
        $this->dateDestruction = $dateDestruction;

        return $this;
    }

    /**
     * @return Collection<int, Artiste>
     */
    public function getArtiste(): Collection
    {
        return $this->Artiste;
    }

    public function addArtiste(Artiste $artiste): static
    {
        if (!$this->Artiste->contains($artiste)) {
            $this->Artiste->add($artiste);
            $artiste->addOeuvre($this);
        }

        return $this;
    }

    public function removeArtiste(Artiste $artiste): static
    {
        if ($this->Artiste->removeElement($artiste)) {
            $artiste->removeOeuvre($this);
        }

        return $this;
    }

    public function getLieu(): ?Lieu
    {
        return $this->Lieu;
    }

    public function setLieu(?Lieu $Lieu): static
    {
        $this->Lieu = $Lieu;

        return $this;
    }

    /**
     * @return Collection<int, Technique>
     */
    public function getTechnique(): Collection
    {
        return $this->Technique;
    }

    public function addTechnique(Technique $technique): static
    {
        if (!$this->Technique->contains($technique)) {
            $this->Technique->add($technique);
        }

        return $this;
    }

    public function removeTechnique(Technique $technique): static
    {
        $this->Technique->removeElement($technique);

        return $this;
    }

    public function getOeuvre(): ?self
    {
        return $this->Oeuvre;
    }

    public function setOeuvre(?self $Oeuvre): static
    {
        $this->Oeuvre = $Oeuvre;

        return $this;
    }

    /**
     * @return Collection<int, Photo>
     */
    public function getPhoto(): Collection
    {
        return $this->Photo;
    }

    public function addPhoto(Photo $photo): static
    {
        if (!$this->Photo->contains($photo)) {
            $this->Photo->add($photo);
            $photo->setOeuvre($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): static
    {
        if ($this->Photo->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getOeuvre() === $this) {
                $photo->setOeuvre(null);
            }
        }

        return $this;
    }
}
