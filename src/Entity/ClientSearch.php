<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

class ClientSearch
{
    private $client;
    public function getClient(): ?Client
    {
        return $this->client;
    }
    public function setClient(?Client $client): self
    {
        $this->client = $client;
        return $this;
    }
}

?>