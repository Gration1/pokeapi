<?php

namespace App\Repositories\Pokemon;

use App\Models\Pokemon;
use Illuminate\Support\Collection;

interface PokemonRepositoryInterface
{
    /**
     * @param \App\Data\Pokemon\PokemonCreateData[] $createData
     */
    function upsert(array $createData): void;

    /**
     * @param int[] $orders
     * @return Collection<\App\Models\Pokemon>
     */
    function getMultipleByOrder(array $orders): Collection;

    function get(int $id): ?Pokemon;
}
