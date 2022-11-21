<?php

namespace App\Services\Pokemon;

use App\Data\Pokemon\PokemonIndexData;
use App\Data\Pokemon\PokemonPaginatedIndexData;
use App\Data\Pokemon\PokemonPaginatedResponseData;
use App\Data\Pokemon\PokemonSearchData;
use App\Models\Pokemon;
use Illuminate\Support\Collection;

interface PokemonServiceInterface
{
    /**
     * @param \App\Data\Pokemon\PokemonCreateData[] $pokemonCreateData
     */
    function import(array $pokemonCreateData): void;

    /**
     * @return Collection<\App\Models\Pokemon>
     */
    function index(PokemonIndexData $data): Collection;

    function get(int $id): Pokemon;

    function paginated(PokemonPaginatedIndexData $data): PokemonPaginatedResponseData;

    /**
     * @return Collection<\App\Models\Pokemon>
     */
    function search(PokemonSearchData $data): Collection;
}
