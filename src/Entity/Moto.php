<?php

declare(strict_types = 1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource]
#[ORM\Entity]
#[ORM\Table(name: 'Moto')]
#[ORM\AttributeOverrides(
    new ORM\AttributeOverride(name: "id", column: new ORM\Column(name: "id_moto", type: "integer"))
)]
class Moto
{
    use Commons\Base;
    use Commons\Versionable;

    /**
     * El modelo de la moto
     */
    #[ORM\Column(type: "string", length: 50, nullable: false)]
    #[Assert\NotBlank]
    private string $modelo;

    /**
     * La cilindrada de la moto
     */
    #[ORM\Column(type: "integer", nullable: false)]
    #[Assert\PositiveOrZero]
    private int $cilindrada;

    /**
     * La marca de la moto
     */
    #[ORM\Column(type: "string", length: 40, nullable: false)]
    #[Assert\NotBlank]
    private string $marca;

    /**
     * El tipo de la moto
     */
    #[ORM\Column(type: "string", nullable: false)]
    private string $tipo;

    /**
     * El peso de la moto
     */
    #[ORM\Column(type: "integer", nullable: true)]
    #[Assert\PositiveOrZero]
    private ?int $peso = null;

    /**
     * Extras de la moto
     */
    #[ORM\Column(type: "json", nullable: false)]
    #[Assert\Count(max:20)]
    private array $extras = [];

    /**
     * Fecha de creación del elemento moto
     */
    #[ORM\Column(type: "datetime", nullable: false, updatable: false)]
    private DateTime $createdAt;

    /**
     * Indica si la moto es de edición limitada
     */
    #[ORM\Column(type: "boolean", nullable: false, updatable: false)]
    private bool $edicionLimitada;

    /**
     * Constructor
     *
     * Se inicializan las fechas
     */
    public function __construct()
    {
        $this->updatedAt = new DateTime();
        $this->createdAt = new DateTime();
    }

    /**
     * Obtener el modelo de la moto
     *
     * @return string
     */
    public function getModelo(): string
    {
        return $this->modelo;
    }

    /**
     * Establecer el modelo de la moto
     *
     * @param string $modelo
     * @return $this
     */
    public function setModelo(string $modelo): self
    {
        $this->modelo = $modelo;

        return $this;
    }

    /**
     * Obtener la cilindrada de la moto
     *
     * @return int
     */
    public function getCilindrada(): int
    {
        return $this->cilindrada;
    }

    /**
     * Establecer la cilindrada de la moto
     *
     * @param int $cilindrada
     * @return $this
     */
    public function setCilindrada(int $cilindrada): self
    {
        $this->cilindrada = $cilindrada;

        return $this;
    }

    /**
     * Obtener el tipo de la moto
     *
     * @return string
     */
    public function getTipo(): string
    {
        return $this->tipo;
    }

    /**
     * Establecer el tipo de la moto
     *
     * @param string $tipo
     * @return $this
     */
    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Obtener la marca de la moto
     *
     * @return string
     */
    public function getMarca(): string
    {
        return $this->marca;
    }

    /**
     * Establecer la marca de la moto
     *
     * @param string $marca
     * @return $this
     */
    public function setMarca(string $marca): self
    {
        $this->marca = $marca;

        return $this;
    }

    /**
     * Extras la moto
     *
     * @return string[]
     */
    public function getExtras(): array
    {
        return $this->extras;
    }

    /**
     * Establecer los extras de la moto
     *
     * @param string[] $extras
     * @return $this
     */
    public function setExtras(array $extras): self
    {
        $this->extras = $extras;

        return $this;
    }

    /**
     * Obtener el peso de la moto
     *
     * @return int|null
     */
    public function getPeso(): ?int
    {
        return $this->peso;
    }

    /**
     * Establecer el peso de la moto
     *
     * @param int|null $peso
     * @return $this
     */
    public function setPeso(?int $peso): self
    {
        $this->peso = $peso;

        return $this;
    }

    /**
     * Obtener la fecha de creación de la fila (no de la moto como tal)
     *
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * Obtener la fecha de creación
     *
     * @param DateTime $createdAt
     * @return $this
     */
    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Obtener si la moto es de edición limitada
     *
     * @return bool
     */
    public function isEdicionLimitada(): bool
    {
        return $this->edicionLimitada;
    }

    /**
     * Establecer si la moto es de edición limitada
     *
     * @param bool $edicionLimitada
     * @return $this
     */
    public function setEdicionLimitada(bool $edicionLimitada): self
    {
        $this->edicionLimitada = $edicionLimitada;

        return $this;
    }
}
