<?php

namespace App\Data\Pokemon;

use Spatie\LaravelData\Data;

class PokemonMoveVersionGroupDetail extends Data
{
    public function __construct(public string $move_learn_method, public string $version_group, public int $level_learned_at)
    {
    }
}
