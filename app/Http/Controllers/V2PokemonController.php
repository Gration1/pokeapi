<?php

namespace App\Http\Controllers;

use App\Data\Pokemon\PokemonPaginatedIndexData;
use App\Data\Pokemon\PokemonResponseData;
use App\Services\Pokemon\PokemonServiceInterface;

class V2PokemonController extends Controller
{
    public function __construct(protected PokemonServiceInterface $pokemonService)
    {
    }

    public function index(PokemonPaginatedIndexData $data)
    {
        return $this->pokemonService->paginated($data);
    }
}
