<?php

namespace App\Data\Team;

use App\Models\Team;
use Spatie\LaravelData\Data;

class TeamResponseData extends Data
{
    public function __construct(public int $id, public string $name, array $pokemons)
    {
    }

    public static function fromModel(Team $team): self
    {
        $pokemonIds = $team->pokemon->pluck('id')->toArray();
        return new self(id: $team->id, name: $team->name, pokemons: $pokemonIds);
    }
}
