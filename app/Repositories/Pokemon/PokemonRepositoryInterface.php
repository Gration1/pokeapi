<?php

namespace App\Repositories\Pokemon;

interface PokemonRepositoryInterface
{
    /**
     * @param \App\Data\Pokemon\PokemonCreateData[] $createData
     */
    function upsert(array $createData): void;
}
