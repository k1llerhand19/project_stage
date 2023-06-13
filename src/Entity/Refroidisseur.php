<?php

namespace App\Entity;

use App\Repository\RefroidisseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RefroidisseurRepository::class)]
class Refroidisseur
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

    #[ORM\Column(length: 50)]
    private ?string $supportcpu = null;

    #[ORM\Column]
    private ?int $vitesserotationminimum = null;

    #[ORM\Column]
    private ?int $vitesserotationmaximum = null;

    #[ORM\OneToMany(mappedBy: 'refroidisseur', targetEntity: Ordinateur::class)]
    private Collection $refroidisseur_id;

    public function __construct()
    {
        $this->refroidisseur_id = new ArrayCollection();
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

    public function getVitesserotationminimum(): ?int
    {
        return $this->vitesserotationminimum;
    }

    public function setVitesserotationminimum(int $vitesserotationminimum): static
    {
        $this->vitesserotationminimum = $vitesserotationminimum;

        return $this;
    }

    public function getVitesserotationmaximum(): ?int
    {
        return $this->vitesserotationmaximum;
    }

    public function setVitesserotationmaximum(int $vitesserotationmaximum): static
    {
        $this->vitesserotationmaximum = $vitesserotationmaximum;

        return $this;
    }

    /**
     * @return Collection<int, Ordinateur>
     */
    public function getRefroidisseurId(): Collection
    {
        return $this->refroidisseur_id;
    }

    public function addRefroidisseurId(Ordinateur $refroidisseurId): static
    {
        if (!$this->refroidisseur_id->contains($refroidisseurId)) {
            $this->refroidisseur_id->add($refroidisseurId);
            $refroidisseurId->setRefroidisseur($this);
        }

        return $this;
    }

    public function removeRefroidisseurId(Ordinateur $refroidisseurId): static
    {
        if ($this->refroidisseur_id->removeElement($refroidisseurId)) {
            // set the owning side to null (unless already changed)
            if ($refroidisseurId->getRefroidisseur() === $this) {
                $refroidisseurId->setRefroidisseur(null);
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
