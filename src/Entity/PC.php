<?php

namespace App\Entity;

use App\Repository\PCRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PCRepository::class)]
class PC
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produit $CodP = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commande $NumC = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: '0')]
    private ?string $QteC = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodP(): ?Produit
    {
        return $this->CodP;
    }

    public function setCodP(?Produit $CodP): self
    {
        $this->CodP = $CodP;

        return $this;
    }

    public function getNumC(): ?Commande
    {
        return $this->NumC;
    }

    public function setNumC(?Commande $NumC): self
    {
        $this->NumC = $NumC;

        return $this;
    }

    public function getQteC(): ?string
    {
        return $this->QteC;
    }

    public function setQteC(string $QteC): self
    {
        $this->QteC = $QteC;

        return $this;
    }

    public function __toString()
    {
        return $this->Id;
    }
}
