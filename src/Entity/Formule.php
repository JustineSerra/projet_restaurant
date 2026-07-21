<?php

namespace App\Entity;

use App\Repository\FormuleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormuleRepository::class)]
class Formule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_formule')]
    private ?int $id_formule = null;

    #[ORM\Column(length: 50)]
    private ?string $nom_formule = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 2)]
    private ?string $prix_formule = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description_formule = null;

    /**
     * @var Collection<int, Plat>
     */
    #[ORM\ManyToMany(targetEntity: Plat::class, inversedBy: 'formules')]
    private Collection $plats;

    public function __construct()
    {
        $this->plats = new ArrayCollection();
    }

    public function getIdFormule(): ?int
    {
        return $this->id_formule;
    }

    public function getNomFormule(): ?string
    {
        return $this->nom_formule;
    }

    public function setNomFormule(string $nom_formule): static
    {
        $this->nom_formule = $nom_formule;

        return $this;
    }

    public function getPrixFormule(): ?string
    {
        return $this->prix_formule;
    }

    public function setPrixFormule(string $prix_formule): static
    {
        $this->prix_formule = $prix_formule;

        return $this;
    }

    public function getDescriptionFormule(): ?string
    {
        return $this->description_formule;
    }

    public function setDescriptionFormule(string $description_formule): static
    {
        $this->description_formule = $description_formule;

        return $this;
    }

    /**
     * @return Collection<int, Plat>
     */
    public function getPlats(): Collection
    {
        return $this->plats;
    }

    public function addPlat(Plat $plat): static
    {
        if (!$this->plats->contains($plat)) {
            $this->plats->add($plat);
        }

        return $this;
    }

    public function removePlat(Plat $plat): static
    {
        $this->plats->removeElement($plat);

        return $this;
    }
}
