<?php

namespace App\Entity;

use App\Repository\PlatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlatRepository::class)]
class Plat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_plat')]
    private ?int $id_plat = null;

    #[ORM\Column(name: 'nom_plat', length: 50)]
    private ?string $nom_plat = null;

    #[ORM\Column(name: 'description_plat', type: Types::TEXT)]
    private ?string $description_plat = null;

    #[ORM\Column(name: 'prix_plat', type: Types::DECIMAL, precision: 15, scale: 2)]
    private ?string $prix_plat = null;

    #[ORM\ManyToOne(targetEntity: Categorie::class)]
    #[ORM\JoinColumn(name: 'id_categorie', referencedColumnName: 'id_categorie', nullable: false)]
    private ?Categorie $categorie = null;

    /**
     * @var Collection<int, Formule>
     */
    #[ORM\ManyToMany(targetEntity: Formule::class, mappedBy: 'plats')]
    private Collection $formules;

    public function __construct()
    {
        $this->formules = new ArrayCollection();
    }

    public function getIdPlat(): ?int
    {
        return $this->id_plat;
    }

    public function getNomPlat(): ?string
    {
        return $this->nom_plat;
    }

    public function setNomPlat(string $nom_plat): static
    {
        $this->nom_plat = $nom_plat;

        return $this;
    }

    public function getDescriptionPlat(): ?string
    {
        return $this->description_plat;
    }

    public function setDescriptionPlat(string $description_plat): static
    {
        $this->description_plat = $description_plat;

        return $this;
    }

    public function getPrixPlat(): ?string
    {
        return $this->prix_plat;
    }

    public function setPrixPlat(string $prix_plat): static
    {
        $this->prix_plat = $prix_plat;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, Formule>
     */
    public function getFormules(): Collection
    {
        return $this->formules;
    }

    public function addFormule(Formule $formule): static
    {
        if (!$this->formules->contains($formule)) {
            $this->formules->add($formule);
            $formule->addPlat($this);
        }

        return $this;
    }

    public function removeFormule(Formule $formule): static
    {
        if ($this->formules->removeElement($formule)) {
            $formule->removePlat($this);
        }

        return $this;
    }
}