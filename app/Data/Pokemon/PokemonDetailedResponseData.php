<?php

namespace App\Data\Pokemon;

use App\Models\Pokemon;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class PokemonDetailedResponseData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public PokemonSpriteData $sprites,
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

    public static function fromModel(Pokemon $pokemon): self
    {
        return new self(
            id: $pokemon->id,
            name: $pokemon->name,
            sprites: new PokemonSpriteData(
                front_default: $pokemon->getFirstMedia('front_default')?->getUrl(),
                front_female: $pokemon->getFirstMedia('front_female')?->getUrl(),
                front_shiny: $pokemon->getFirstMedia('front_shiny')?->getUrl(),
                front_shiny_female: $pokemon->getFirstMedia('front_shiny_female')?->getUrl(),
                back_default: $pokemon->getFirstMedia('back_default')?->getUrl(),
                back_female: $pokemon->getFirstMedia('back_female')?->getUrl(),
                back_shiny: $pokemon->getFirstMedia('back_shiny')?->getUrl(),
                back_shiny_female: $pokemon->getFirstMedia('back_shiny_female')?->getUrl(),
            ),
            types: $pokemon->types,
            height: $pokemon->height,
            weight: $pokemon->weight,
            moves: $pokemon->moves,
            order: $pokemon->order,
            species: $pokemon->species,
            stats: $pokemon->stats,
            abilities: $pokemon->abilities,
            form: $pokemon->form,
        );
    }
}
