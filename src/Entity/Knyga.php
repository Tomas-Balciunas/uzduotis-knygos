<?php

namespace App\Entity;

use App\Repository\KnygaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: KnygaRepository::class)]
#[UniqueEntity(fields: 'isbn', message: 'ISBN numeris jau egzistuoja.')]
class Knyga
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $pavadinimas = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $isleidimoMetai = null;

    #[ORM\ManyToOne(targetEntity: Autorius::class, inversedBy: "knygos")]
    private ?Autorius $autorius = null;

    #[ORM\Column(length: 17)]
    #[Assert\Regex('/((978[\--– ])?[0-9][0-9\--– ]{10}[\--– ][0-9xX])|((978)?[0-9]{9}[0-9Xx])/', message: 'Neteisingas ISBN numeris.')]
    private ?string $isbn = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPavadinimas(): ?string
    {
        return $this->pavadinimas;
    }

    public function setPavadinimas(string $pavadinimas): static
    {
        $this->pavadinimas = $pavadinimas;

        return $this;
    }

    public function getIsleidimoMetai(): ?\DateTimeInterface
    {
        return $this->isleidimoMetai;
    }

    public function setIsleidimoMetai(\DateTimeInterface $isleidimoMetai): static
    {
        $this->isleidimoMetai = $isleidimoMetai;

        return $this;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn): static
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function setAutorius(Autorius $autorius): static
    {
        $this->autorius = $autorius;

        return $this;
    }

    public function getAutorius(): Autorius|null
    {
        return $this->autorius;
    }
}
