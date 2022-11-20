<?php

namespace App\Http\Controllers;

use App\Data\Pokemon\PokemonDetailedResponseData;
use App\Services\Pokemon\PokemonServiceInterface;

class V1PokemonController extends Controller
{
    public function __construct(protected PokemonServiceInterface $pokemonService)
    {
    }

    public function get(int $id): PokemonDetailedResponseData
    {
        $pokemon = $this->pokemonService->get($id);
        return PokemonDetailedResponseData::from($pokemon);
    }
}
