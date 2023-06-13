<?php

namespace App\Entity;

use App\Repository\SsdRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SsdRepository::class)]
class Ssd
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
    private ?int $vitesselecture = null;

    #[ORM\Column]
    private ?int $vitesseecriture = null;

    #[ORM\OneToMany(mappedBy: 'ssd', targetEntity: Ordinateur::class)]
    private Collection $ssd_id;

    public function __construct()
    {
        $this->ssd_id = new ArrayCollection();
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

    public function getVitesselecture(): ?int
    {
        return $this->vitesselecture;
    }

    public function setVitesselecture(int $vitesselecture): static
    {
        $this->vitesselecture = $vitesselecture;

        return $this;
    }

    public function getVitesseecriture(): ?int
    {
        return $this->vitesseecriture;
    }

    public function setVitesseecriture(int $vitesseecriture): static
    {
        $this->vitesseecriture = $vitesseecriture;

        return $this;
    }

    /**
     * @return Collection<int, Ordinateur>
     */
    public function getSsdId(): Collection
    {
        return $this->ssd_id;
    }

    public function addSsdId(Ordinateur $ssdId): static
    {
        if (!$this->ssd_id->contains($ssdId)) {
            $this->ssd_id->add($ssdId);
            $ssdId->setSsd($this);
        }

        return $this;
    }

    public function removeSsdId(Ordinateur $ssdId): static
    {
        if ($this->ssd_id->removeElement($ssdId)) {
            // set the owning side to null (unless already changed)
            if ($ssdId->getSsd() === $this) {
                $ssdId->setSsd(null);
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
