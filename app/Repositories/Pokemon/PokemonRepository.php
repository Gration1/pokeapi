<?php

namespace App\Repositories\Pokemon;

use App\Data\Pokemon\PokemonCreateData;
use Illuminate\Support\Facades\DB;

class PokemonRepository implements PokemonRepositoryInterface
{
    public function upsert(array $createData): void
    {
        $mappedData = array_map(
            fn(PokemonCreateData $createDataEntry) => [
                ...$createDataEntry->toArray(),
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
}
