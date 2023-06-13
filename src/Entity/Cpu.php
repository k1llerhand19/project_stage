<?php

namespace App\Entity;

use App\Repository\CpuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CpuRepository::class)]
class Cpu
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
    private ?float $frequencecpu = null;

    #[ORM\Column]
    private ?int $nbrcore = null;

    #[ORM\Column]
    private ?int $nbrthreads = null;

    #[ORM\OneToMany(mappedBy: 'cpu', targetEntity: Ordinateur::class)]
    private Collection $cpu_id;

    public function __construct()
    {
        $this->cpu_id = new ArrayCollection();
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

    public function getFrequencecpu(): ?float
    {
        return $this->frequencecpu;
    }

    public function setFrequencecpu(float $frequencecpu): static
    {
        $this->frequencecpu = $frequencecpu;

        return $this;
    }

    public function getNbrcore(): ?int
    {
        return $this->nbrcore;
    }

    public function setNbrcore(int $nbrcore): static
    {
        $this->nbrcore = $nbrcore;

        return $this;
    }

    public function getNbrthreads(): ?int
    {
        return $this->nbrthreads;
    }

    public function setNbrthreads(int $nbrthreads): static
    {
        $this->nbrthreads = $nbrthreads;

        return $this;
    }

    /**
     * @return Collection<int, Ordinateur>
     */
    public function getCpuId(): Collection
    {
        return $this->cpu_id;
    }

    public function addCpuId(Ordinateur $cpuId): static
    {
        if (!$this->cpu_id->contains($cpuId)) {
            $this->cpu_id->add($cpuId);
            $cpuId->setCpu($this);
        }

        return $this;
    }

    public function removeCpuId(Ordinateur $cpuId): static
    {
        if ($this->cpu_id->removeElement($cpuId)) {
            // set the owning side to null (unless already changed)
            if ($cpuId->getCpu() === $this) {
                $cpuId->setCpu(null);
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
