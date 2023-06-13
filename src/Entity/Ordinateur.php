<?php

namespace App\Entity;

use App\Repository\OrdinateurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdinateurRepository::class)]
class Ordinateur
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

    #[ORM\ManyToOne(inversedBy: 'alim_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Alimentation $alim = null;

    #[ORM\ManyToOne(inversedBy: 'boitier_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Boitier $boitier = null;

    #[ORM\ManyToOne(inversedBy: 'cartemere_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cartemere $cartemere = null;

    #[ORM\ManyToOne(inversedBy: 'cpu_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cpu $cpu = null;

    #[ORM\ManyToOne(inversedBy: 'gpu_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Gpu $gpu = null;

    #[ORM\ManyToOne(inversedBy: 'hdd_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Hdd $hdd = null;

    #[ORM\ManyToOne(inversedBy: 'ram_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ram $ram = null;

    #[ORM\ManyToOne(inversedBy: 'refroidisseur_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Refroidisseur $refroidisseur = null;

    #[ORM\ManyToOne(inversedBy: 'ssd_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ssd $ssd = null;

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

    public function getAlim(): ?Alimentation
    {
        return $this->alim;
    }

    public function setAlim(?Alimentation $alim): static
    {
        $this->alim = $alim;

        return $this;
    }

    public function getBoitier(): ?Boitier
    {
        return $this->boitier;
    }

    public function setBoitier(?Boitier $boitier): static
    {
        $this->boitier = $boitier;

        return $this;
    }

    public function getCartemere(): ?Cartemere
    {
        return $this->cartemere;
    }

    public function setCartemere(?Cartemere $cartemere): static
    {
        $this->cartemere = $cartemere;

        return $this;
    }

    public function getCpu(): ?Cpu
    {
        return $this->cpu;
    }

    public function setCpu(?Cpu $cpu): static
    {
        $this->cpu = $cpu;

        return $this;
    }

    public function getGpu(): ?Gpu
    {
        return $this->gpu;
    }

    public function setGpu(?Gpu $gpu): static
    {
        $this->gpu = $gpu;

        return $this;
    }

    public function getHdd(): ?Hdd
    {
        return $this->hdd;
    }

    public function setHdd(?Hdd $hdd): static
    {
        $this->hdd = $hdd;

        return $this;
    }

    public function getRam(): ?Ram
    {
        return $this->ram;
    }

    public function setRam(?Ram $ram): static
    {
        $this->ram = $ram;

        return $this;
    }

    public function getRefroidisseur(): ?Refroidisseur
    {
        return $this->refroidisseur;
    }

    public function setRefroidisseur(?Refroidisseur $refroidisseur): static
    {
        $this->refroidisseur = $refroidisseur;

        return $this;
    }

    public function getSsd(): ?Ssd
    {
        return $this->ssd;
    }

    public function setSsd(?Ssd $ssd): static
    {
        $this->ssd = $ssd;

        return $this;
    }
    
}
