<?php

namespace App\Entity;

use App\Repository\GpuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GpuRepository::class)]
class Gpu
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
    private ?string $chipsetgraphique = null;

    #[ORM\Column]
    private ?int $taillememoire = null;

    #[ORM\Column(length: 25)]
    private ?string $typememoire = null;

    #[ORM\OneToMany(mappedBy: 'gpu', targetEntity: Ordinateur::class)]
    private Collection $gpu_id;

    public function __construct()
    {
        $this->gpu_id = new ArrayCollection();
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

    public function getChipsetgraphique(): ?string
    {
        return $this->chipsetgraphique;
    }

    public function setChipsetgraphique(string $chipsetgraphique): static
    {
        $this->chipsetgraphique = $chipsetgraphique;

        return $this;
    }

    public function getTaillememoire(): ?int
    {
        return $this->taillememoire;
    }

    public function setTaillememoire(int $taillememoire): static
    {
        $this->taillememoire = $taillememoire;

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

    /**
     * @return Collection<int, Ordinateur>
     */
    public function getGpuId(): Collection
    {
        return $this->gpu_id;
    }

    public function addGpuId(Ordinateur $gpuId): static
    {
        if (!$this->gpu_id->contains($gpuId)) {
            $this->gpu_id->add($gpuId);
            $gpuId->setGpu($this);
        }

        return $this;
    }

    public function removeGpuId(Ordinateur $gpuId): static
    {
        if ($this->gpu_id->removeElement($gpuId)) {
            // set the owning side to null (unless already changed)
            if ($gpuId->getGpu() === $this) {
                $gpuId->setGpu(null);
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
