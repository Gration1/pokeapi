<?php

namespace App\Http\Controllers;

use App\Data\Pokemon\PokemonDetailedResponseData;
use App\Data\Pokemon\PokemonIndexData;
use App\Data\Pokemon\PokemonResponseData;
use App\Data\Pokemon\PokemonSearchData;
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

    public function index(PokemonIndexData $data)
    {
        $pokemon = $this->pokemonService->index($data);
        return PokemonResponseData::collection($pokemon);
    }

    public function search(PokemonSearchData $data)
    {
        $pokemon = $this->pokemonService->search($data);
        return PokemonResponseData::collection($pokemon);
    }
}
