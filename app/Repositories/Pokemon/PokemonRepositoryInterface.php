<?php

namespace App\Repositories\Pokemon;

use App\Data\Pokemon\PokemonSearchData;
use App\Enums\PokemonSort;
use App\Models\Pokemon;
use Illuminate\Support\Collection;

interface PokemonRepositoryInterface
{
    /**
     * @param \App\Data\Pokemon\PokemonCreateData[] $createData
     */
    function upsert(array $createData): void;

    /**
     * @return Collection<\App\Models\Pokemon>
     */
    function all(?PokemonSort $sort = null): Collection;

    function get(int $id): ?Pokemon;

    /**
     * @param int[] $orders
     * @return Collection<\App\Models\Pokemon>
     */
    function getMultipleByOrder(array $orders): Collection;

    /**
     * @return Collection<\App\Models\Pokemon>
     */
    function search(PokemonSearchData $data): Collection;
}
