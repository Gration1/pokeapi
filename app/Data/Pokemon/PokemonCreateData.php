<?php

namespace App\Data\Pokemon;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class PokemonCreateData extends Data
{
    public function __construct(
        public string $name,
        #[DataCollectionOf(PokemonTypeData::class)] public DataCollection $types,
        public int $height,
        public int $weight,
        #[DataCollectionOf(PokemonMoveData::class)] public DataCollection $moves,
        public int $order,
        public string $species,
        #[DataCollectionOf(PokemonStatData::class)] public DataCollection $stats,
        #[DataCollectionOf(PokemonAbilityData::class)] public DataCollection $abilities,
        public string $form,
    ) {
    }
}
