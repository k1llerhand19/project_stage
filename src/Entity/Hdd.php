<?php

namespace App\Entity;

use App\Repository\HddRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HddRepository::class)]
class Hdd
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

    #[ORM\Column]
    private ?int $capacite = null;

    #[ORM\Column]
    private ?int $vitesserotation = null;

    #[ORM\OneToMany(mappedBy: 'hdd', targetEntity: Ordinateur::class)]
    private Collection $hdd_id;

    public function __construct()
    {
        $this->hdd_id = new ArrayCollection();
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

    public function getCapacite(): ?int
    {
        return $this->capacite;
    }

    public function setCapacite(int $capacite): static
    {
        $this->capacite = $capacite;

        return $this;
    }

    public function getVitesserotation(): ?int
    {
        return $this->vitesserotation;
    }

    public function setVitesserotation(int $vitesserotation): static
    {
        $this->vitesserotation = $vitesserotation;

        return $this;
    }

    /**
     * @return Collection<int, Ordinateur>
     */
    public function getHddId(): Collection
    {
        return $this->hdd_id;
    }

    public function addHddId(Ordinateur $hddId): static
    {
        if (!$this->hdd_id->contains($hddId)) {
            $this->hdd_id->add($hddId);
            $hddId->setHdd($this);
        }

        return $this;
    }

    public function removeHddId(Ordinateur $hddId): static
    {
        if ($this->hdd_id->removeElement($hddId)) {
            // set the owning side to null (unless already changed)
            if ($hddId->getHdd() === $this) {
                $hddId->setHdd(null);
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
