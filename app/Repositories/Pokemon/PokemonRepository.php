<?php

namespace App\Repositories\Pokemon;

use App\Data\Pokemon\PokemonCreateData;
use App\Data\Pokemon\PokemonSearchData;
use App\Enums\PokemonSort;
use App\Models\Pokemon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PokemonRepository implements PokemonRepositoryInterface
{
    public function upsert(array $createData): void
    {
        $mappedData = array_map(
            fn(PokemonCreateData $createDataEntry) => [
                ...$createDataEntry->except('sprites')->toArray(),
                'types' => $createDataEntry->types->toJson(),
                'moves' => $createDataEntry->moves->toJson(),
                'stats' => $createDataEntry->stats->toJson(),
                'abilities' => $createDataEntry->abilities->toJson(),
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()'),
            ],
            $createData,
        );

        DB::table('pokemon')->upsert($mappedData, ['order'], ['name', 'types', 'height', 'weight', 'moves', 'order', 'species', 'stats', 'abilities', 'form', 'updated_at']);
    }

    public function all(?PokemonSort $sort = null): Collection
    {
        $baseQuery = Pokemon::with('media');
        if ($sort === PokemonSort::idAsc) {
            return $baseQuery->orderBy('id')->get();
        }
        if ($sort === PokemonSort::idDesc) {
            return $baseQuery->orderByDesc('id')->get();
        }
        if ($sort === PokemonSort::nameAsc) {
            return $baseQuery->orderBy('name')->get();
        }
        if ($sort === PokemonSort::nameDesc) {
            return $baseQuery->orderByDesc('name')->get();
        }
        return $baseQuery->get();
    }

    public function get(int $id): ?Pokemon
    {
        return Pokemon::find($id);
    }

    public function getMultipleByOrder(array $orders): Collection
    {
        return Pokemon::whereIn('order', $orders)->get();
    }

    public function search(PokemonSearchData $data): Collection
    {
        $query = Pokemon::search($data->query);
        if ($data->limit === null) {
            return $query->get();
        }
        return $query->take($data->limit)->get();
    }
}
