<?php

namespace App\Data\Pokemon;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class PokemonMoveData extends Data
{
    public function __construct(public string $move, #[DataCollectionOf(PokemonMoveVersionGroupDetail::class)] public DataCollection $version_group_details)
    {
    }
}
