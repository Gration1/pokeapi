<?php

namespace App\Services\Pokemon;

interface PokemonServiceInterface
{
    /**
     * @param \App\Data\Pokemon\PokemonCreateData[] $pokemonCreateData
     */
    function import(array $pokemonCreateData): void;
}
