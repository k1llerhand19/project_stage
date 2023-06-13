<?php

namespace App\Entity;

use App\Repository\RamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RamRepository::class)]
class Ram
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

    #[ORM\Column(length: 20)]
    private ?string $typememoire = null;

    #[ORM\Column]
    private ?int $frequencememoire = null;

    #[ORM\Column]
    private ?int $capaciteparbarrette = null;

    #[ORM\OneToMany(mappedBy: 'ram', targetEntity: Ordinateur::class)]
    private Collection $ram_id;

    public function __construct()
    {
        $this->ram_id = new ArrayCollection();
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

    public function getTypememoire(): ?string
    {
        return $this->typememoire;
    }

    public function setTypememoire(string $typememoire): static
    {
        $this->typememoire = $typememoire;

        return $this;
    }

    public function getFrequencememoire(): ?int
    {
        return $this->frequencememoire;
    }

    public function setFrequencememoire(int $frequencememoire): static
    {
        $this->frequencememoire = $frequencememoire;

        return $this;
    }

    public function getCapaciteparbarrette(): ?int
    {
        return $this->capaciteparbarrette;
    }

    public function setCapaciteparbarrette(int $capaciteparbarrette): static
    {
        $this->capaciteparbarrette = $capaciteparbarrette;

        return $this;
    }

    /**
     * @return Collection<int, Ordinateur>
     */
    public function getRamId(): Collection
    {
        return $this->ram_id;
    }

    public function addRamId(Ordinateur $ramId): static
    {
        if (!$this->ram_id->contains($ramId)) {
            $this->ram_id->add($ramId);
            $ramId->setRam($this);
        }

        return $this;
    }

    public function removeRamId(Ordinateur $ramId): static
    {
        if ($this->ram_id->removeElement($ramId)) {
            // set the owning side to null (unless already changed)
            if ($ramId->getRam() === $this) {
                $ramId->setRam(null);
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
