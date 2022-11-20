<?php

namespace App\Data\Pokemon;

use App\Enums\PokemonSort;
use Spatie\LaravelData\Attributes\Validation\In;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;

class PokemonIndexData extends Data
{
    public $a;
    public function __construct(#[In(['name-asc', 'name-desc', 'id-asc', 'id-desc']), WithCast(EnumCast::class)] public ?PokemonSort $sort = null)
    {
    }
}
