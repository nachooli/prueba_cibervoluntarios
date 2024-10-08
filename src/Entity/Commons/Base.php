<?php

declare(strict_types = 1);

namespace App\Entity\Commons;

use Doctrine\ORM\Mapping as ORM;

trait Base
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(name: "id", type: 'integer')]
    private int $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }
}