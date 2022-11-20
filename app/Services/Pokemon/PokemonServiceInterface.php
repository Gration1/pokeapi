<?php

namespace App\Services\Pokemon;

use App\Models\Pokemon;

interface PokemonServiceInterface
{
    /**
     * @param \App\Data\Pokemon\PokemonCreateData[] $pokemonCreateData
     */
    function import(array $pokemonCreateData): void;

    function get(int $id): Pokemon;
}
