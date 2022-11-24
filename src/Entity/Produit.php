<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $lib = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 7, scale: 3)]
    private ?string $pu = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: '0')]
    private ?string $QteS = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: '0')]
    private ?string $seuil = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLib(): ?string
    {
        return $this->lib;
    }

    public function setLib(string $lib): self
    {
        $this->lib = $lib;

        return $this;
    }

    public function getPu(): ?string
    {
        return $this->pu;
    }

    public function setPu(string $pu): self
    {
        $this->pu = $pu;

        return $this;
    }

    public function getQteS(): ?string
    {
        return $this->QteS;
    }

    public function setQteS(string $QteS): self
    {
        $this->QteS = $QteS;

        return $this;
    }

    public function getSeuil(): ?string
    {
        return $this->seuil;
    }

    public function setSeuil(string $seuil): self
    {
        $this->seuil = $seuil;

        return $this;
    }

    public function __toString()
    {
        return $this->lib;
    }
}
