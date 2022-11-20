<?php

namespace App\Data\Pokemon;

use Spatie\LaravelData\Data;

class PokemonSpriteData extends Data
{
    public function __construct(
        public string $front_default,
        public ?string $front_female,
        public string $front_shiny,
        public ?string $front_shiny_female,
        public string $back_default,
        public ?string $back_female,
        public string $back_shiny,
        public ?string $back_shiny_female,
    ) {
    }
}
