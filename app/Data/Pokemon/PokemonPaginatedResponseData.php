<?php

namespace App\Data\Pokemon;

use App\Data\PaginationMetaData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class PokemonPaginatedResponseData extends Data
{
    public function __construct(#[DataCollectionOf(PokemonResponseData::class)] public DataCollection $data, public PaginationMetaData $metadata)
    {
    }
}
