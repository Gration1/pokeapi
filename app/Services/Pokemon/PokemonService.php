<?php

namespace App\Services\Pokemon;

use App\Repositories\Pokemon\PokemonRepositoryInterface;

class PokemonService implements PokemonServiceInterface
{
    public function __construct(protected PokemonRepositoryInterface $pokemonRepository)
    {
    }

    public function import(array $pokemonCreateData): void
    {
        $this->pokemonRepository->upsert($pokemonCreateData);
    }
}
