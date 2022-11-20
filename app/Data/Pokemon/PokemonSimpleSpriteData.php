<?php

namespace App\Data\Pokemon;

use Spatie\LaravelData\Data;

class PokemonSimpleSpriteData extends Data
{
    public function __construct(public string $front_default)
    {
    }
}
