<?php

declare(strict_types = 1);

namespace App\Entity\Commons;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

trait Versionable
{
    #[ORM\Column(type: "datetime")]
    #[ORM\Version]
    private DateTimeInterface $updatedAt;

    public function getUpdatedAt(): DateTimeInterface
    {
        return $this->updatedAt;
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function setUpdatedAt(DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
