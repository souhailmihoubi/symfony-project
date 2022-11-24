<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $NomC = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 7, scale: 3)]
    private ?string $CreditC = null;

    #[ORM\Column(length: 45)]
    private ?string $AdrC = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomC(): ?string
    {
        return $this->NomC;
    }

    public function setNomC(string $NomC): self
    {
        $this->NomC = $NomC;

        return $this;
    }

    public function getCreditC(): ?string
    {
        return $this->CreditC;
    }

    public function setCreditC(string $CreditC): self
    {
        $this->CreditC = $CreditC;

        return $this;
    }

    public function getAdrC(): ?string
    {
        return $this->AdrC;
    }

    public function setAdrC(string $AdrC): self
    {
        $this->AdrC = $AdrC;

        return $this;
    }

    public function __toString()
    {
        return $this->NomC;
    }
}
