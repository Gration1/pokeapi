<?php

namespace App\Repositories\Pokemon;

use App\Data\Pokemon\PokemonCreateData;
use App\Data\Pokemon\PokemonPaginatedData;
use App\Data\Pokemon\PokemonPaginatedIndexData;
use App\Data\Pokemon\PokemonResponseData;
use App\Data\Pokemon\PokemonSearchData;
use App\Enums\PokemonSort;
use App\Models\Pokemon;
use Illuminate\Contracts\Database\Eloquent\Builder;
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

        return $this->sortQuery($baseQuery, $sort)->get();
    }

    public function paginated(?PokemonPaginatedIndexData $data): PokemonPaginatedData
    {
        $total = Pokemon::with('media')->count();
        $data = $this->sortQuery(
            Pokemon::with('media')
                ->skip($data->offset)
                ->take($data->limit ?? 10),
            $data->sort,
        )->get();

        return new PokemonPaginatedData(PokemonResponseData::collection($data), $total);
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

    private function sortQuery(Builder $query, ?PokemonSort $sort): Builder
    {
        if ($sort === PokemonSort::idAsc) {
            return $query->orderBy('id');
        }
        if ($sort === PokemonSort::idDesc) {
            return $query->orderByDesc('id');
        }
        if ($sort === PokemonSort::nameAsc) {
            return $query->orderBy('name');
        }
        if ($sort === PokemonSort::nameDesc) {
            return $query->orderByDesc('name');
        }
        return $query;
    }
}
