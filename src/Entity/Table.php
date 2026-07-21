<?php

namespace App\Entity;

use App\Repository\TableRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TableRepository::class)]
#[ORM\Table(name: '`table`')]
class Table
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id_table')]
    private ?int $id_table = null;

    #[ORM\Column(length: 20)]
    private ?string $numero_table = null;

    #[ORM\Column(name: 'capacite_table')]
    private ?int $capacite_table = null;

    /**
     * @var Collection<int, Reservation>
     */
    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'tableRestaurant')]
    private Collection $reservations;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

    public function getIdTable(): ?int
    {
        return $this->id_table;
    }

    public function getNumeroTable(): ?string
    {
        return $this->numero_table;
    }

    public function setNumeroTable(string $numero_table): static
    {
        $this->numero_table = $numero_table;

        return $this;
    }

    public function getCapaciteTable(): ?int
    {
        return $this->capacite_table;
    }

    public function setCapaciteTable(int $capacite_table): static
    {
        $this->capacite_table = $capacite_table;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setTableRestaurant($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getTableRestaurant() === $this) {
                $reservation->setTableRestaurant(null);
            }
        }

        return $this;
    }
}
