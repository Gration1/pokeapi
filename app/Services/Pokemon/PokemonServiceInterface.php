<?php

namespace App\Services\Pokemon;

interface PokemonServiceInterface
{
    /**
     * @param \App\Data\PokemonCreateData[] $pokemonCreateData
     */
    function import(array $pokemonCreateData): void;
}
