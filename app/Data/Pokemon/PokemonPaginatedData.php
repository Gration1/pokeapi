<?php

namespace App\Data\Pokemon;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class PokemonPaginatedData extends Data
{
    public function __construct(#[DataCollectionOf(PokemonResponseData::class)] public DataCollection $data, public int $total)
    {
    }
}
