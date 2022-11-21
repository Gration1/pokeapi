<?php

namespace App\Data\Pokemon;

use Spatie\LaravelData\Data;

class PokemonSearchData extends Data
{
    public function __construct(public string $query, public ?int $limit)
    {
    }
}
