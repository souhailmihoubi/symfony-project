<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FactureRepository::class)]
class Facture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 7, scale: 3)]
    private ?string $MontF = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $DatF = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commande $NumC = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontF(): ?string
    {
        return $this->MontF;
    }

    public function setMontF(string $MontF): self
    {
        $this->MontF = $MontF;

        return $this;
    }

    public function getDatF(): ?\DateTimeInterface
    {
        return $this->DatF;
    }

    public function setDatF(\DateTimeInterface $DatF): self
    {
        $this->DatF = $DatF;

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

    public function __toString()
    {
        return $this->Id;
    }
}
