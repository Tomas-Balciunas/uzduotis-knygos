<?php

namespace App\Entity;

use App\Repository\AutoriusRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AutoriusRepository::class)]
class Autorius
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?string $vardas = null;

    #[ORM\OneToMany(targetEntity: Knyga::class, mappedBy: "autorius", orphanRemoval: "knygos")]
    private Collection $knygos;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVardas(): ?string
    {
        return $this->vardas;
    }

    public function setVardas(string $vardas): static
    {
        $this->vardas = $vardas;

        return $this;
    }

    public function setKnygos(Collection $knygos): static
    {
        $this->knygos = $knygos;

        return $this;
    }

    public function addKnyga(Knyga $knyga): static
    {
        $this->knygos->add($knyga);

        return $this;
    }

    public function getKnygos(): Collection
    {
        return $this->knygos;
    }
}
