<?php

namespace App\Entity;

use App\Repository\BenevoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BenevoleRepository::class)]
class Benevole
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $nom = null;

    #[ORM\Column(length: 20)]
    private ?string $prenom = null;

    #[ORM\Column(length: 50)]
    private ?string $email = null;

    /**
     * @var Collection<int, Photo>
     */
    #[ORM\OneToMany(targetEntity: Photo::class, mappedBy: 'Benevole')]
    private Collection $Photo;

    public function __construct()
    {
        $this->Photo = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

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
            $photo->setBenevole($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): static
    {
        if ($this->Photo->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getBenevole() === $this) {
                $photo->setBenevole(null);
            }
        }

        return $this;
    }
}
