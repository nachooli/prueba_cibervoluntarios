<?php

declare(strict_types = 1);

namespace App\Entity;

/**
 * Indica el tipo de moto
 *
 * (Se podría hacer una clase abstraca de la que heredar para hacer más detallado esto como EnumBase,
 * por ejemplo para poner los nombres más en idioma humano: scooter => "Scooter")
 */
class MotoTipoEnum
{
    public const TIPO_MOTO_SCOOTER = "scooter";
    public const TIPO_MOTO_CROSS = "cross";
    public const TIPO_MOTO_NAKED = "naked";
    public const TIPO_MOTO_CRUISER = "cruiser";
    public const TIPO_MOTO_ENDURO = "enduro";
    public const TIPO_MOTO_DEPORTIVA = "deportiva";
    public const TIPO_MOTO_CUSTOM = "custom";
}
