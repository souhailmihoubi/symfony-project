<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $DatC = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $CodC = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatC(): ?\DateTimeInterface
    {
        return $this->DatC;
    }

    public function setDatC(\DateTimeInterface $DatC): self
    {
        $this->DatC = $DatC;

        return $this;
    }

    public function getCodC(): ?Client
    {
        return $this->CodC;
    }

    public function setCodC(?Client $CodC): self
    {
        $this->CodC = $CodC;

        return $this;
    }

    public function __toString()
    {
        return $this->id.' '.$this->CodC;
    }
}
