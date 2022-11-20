<?php

namespace App\Data\Pokemon;

use Spatie\LaravelData\Data;

class PokemonTypeData extends Data
{
    public function __construct(public string $type, public int $slot)
    {
    }
}
