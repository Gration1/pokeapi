<?php

namespace App\Data\Pokemon;

use Spatie\LaravelData\Data;

class PokemonAbilityData extends Data
{
    public function __construct(public string $ability, public bool $is_hidden, public int $slot)
    {
    }
}
