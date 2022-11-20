<?php

namespace App\Data\Pokemon;

use App\Models\Pokemon;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class PokemonResponseData extends Data
{
    public function __construct(public int $id, public string $name, public PokemonSimpleSpriteData $sprites, #[DataCollectionOf(PokemonTypeData::class)] public DataCollection $types)
    {
    }

    public static function fromModel(Pokemon $pokemon): self
    {
        return new self(id: $pokemon->id, name: $pokemon->name, sprites: new PokemonSimpleSpriteData(front_default: $pokemon->getFirstMedia('front_default')?->getUrl()), types: $pokemon->types);
    }
}
