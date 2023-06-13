<?php

namespace App\Entity;

use App\Repository\CartemereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartemereRepository::class)]
class Cartemere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 25)]
    private ?string $marque = null;

    #[ORM\Column(length: 25)]
    private ?string $modele = null;

    #[ORM\Column(length: 25)]
    private ?string $supportcpu = null;

    #[ORM\Column]
    private ?int $nbrcpusupporte = null;

    #[ORM\Column(length: 25)]
    private ?string $chipset = null;

    #[ORM\Column(length: 25)]
    private ?string $typememoire = null;

    #[ORM\Column]
    private ?int $capacitemaximalramparslot = null;

    #[ORM\Column]
    private ?int $capacitemaximalram = null;

    #[ORM\OneToMany(mappedBy: 'cartemere', targetEntity: Ordinateur::class)]
    private Collection $cartemere_id;

    public function __construct()
    {
        $this->cartemere_id = new ArrayCollection();
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

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): static
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): static
    {
        $this->modele = $modele;

        return $this;
    }

    public function getSupportcpu(): ?string
    {
        return $this->supportcpu;
    }

    public function setSupportcpu(string $supportcpu): static
    {
        $this->supportcpu = $supportcpu;

        return $this;
    }

    public function getNbrcpusupporte(): ?int
    {
        return $this->nbrcpusupporte;
    }

    public function setNbrcpusupporte(int $nbrcpusupporte): static
    {
        $this->nbrcpusupporte = $nbrcpusupporte;

        return $this;
    }

    public function getChipset(): ?string
    {
        return $this->chipset;
    }

    public function setChipset(string $chipset): static
    {
        $this->chipset = $chipset;

        return $this;
    }

    public function getTypememoire(): ?string
    {
        return $this->typememoire;
    }

    public function setTypememoire(string $typememoire): static
    {
        $this->typememoire = $typememoire;

        return $this;
    }

    public function getCapacitemaximalramparslot(): ?int
    {
        return $this->capacitemaximalramparslot;
    }

    public function setCapacitemaximalramparslot(int $capacitemaximalramparslot): static
    {
        $this->capacitemaximalramparslot = $capacitemaximalramparslot;

        return $this;
    }

    public function getCapacitemaximalram(): ?int
    {
        return $this->capacitemaximalram;
    }

    public function setCapacitemaximalram(int $capacitemaximalram): static
    {
        $this->capacitemaximalram = $capacitemaximalram;

        return $this;
    }

    /**
     * @return Collection<int, Ordinateur>
     */
    public function getCartemereId(): Collection
    {
        return $this->cartemere_id;
    }

    public function addCartemereId(Ordinateur $cartemereId): static
    {
        if (!$this->cartemere_id->contains($cartemereId)) {
            $this->cartemere_id->add($cartemereId);
            $cartemereId->setCartemere($this);
        }

        return $this;
    }

    public function removeCartemereId(Ordinateur $cartemereId): static
    {
        if ($this->cartemere_id->removeElement($cartemereId)) {
            // set the owning side to null (unless already changed)
            if ($cartemereId->getCartemere() === $this) {
                $cartemereId->setCartemere(null);
            }
        }

        return $this;
    }

    /**
     * Transform to string
     * 
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getId();
    }
}
