<?php

namespace App\Data\Pokemon;

use Spatie\LaravelData\Data;

class PokemonStatData extends Data
{
    public function __construct(public string $type, public int $base_stat, public int $effort)
    {
    }
}
