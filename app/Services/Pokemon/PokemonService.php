<?php

namespace App\Services\Pokemon;

use App\Data\Pokemon\PokemonSpriteData;
use App\Models\Pokemon;
use App\Repositories\Pokemon\PokemonRepositoryInterface;
use Illuminate\Support\Arr;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PokemonService implements PokemonServiceInterface
{
    public function __construct(protected PokemonRepositoryInterface $pokemonRepository)
    {
    }

    public function get(int $id): Pokemon
    {
        $pokemon = $this->pokemonRepository->get($id);
        if ($pokemon === null) {
            throw new HttpException(404, 'Pokemon not found');
        }
        return $pokemon;
    }

    public function import(array $pokemonCreateData): void
    {
        $this->pokemonRepository->upsert($pokemonCreateData);
        $this->attachSprites($pokemonCreateData);
    }

    /**
     * @param \App\Data\Pokemon\PokemonCreateData[] $pokemonCreateData
     */
    protected function attachSprites(array $pokemonCreateData): void
    {
        $updatedPokemon = $this->pokemonRepository->getMultipleByOrder(Arr::pluck($pokemonCreateData, 'order'));
        foreach ($pokemonCreateData as $pokemonData) {
            /** @var \App\Models\Pokemon | null */
            $pokemonToUpdate = $updatedPokemon->firstWhere('order', $pokemonData->order);
            if ($pokemonToUpdate === null) {
                continue;
            }

            $this->attachSpritesForPokemon($pokemonToUpdate, $pokemonData->sprites);
        }
    }

    protected function attachSpritesForPokemon(Pokemon $pokemon, PokemonSpriteData $spriteData): void
    {
        foreach ($spriteData->all() as $spriteName => $url) {
            if ($url === null) {
                continue;
            }
            $pokemon->addMediaFromUrl($url)->toMediaCollection($spriteName);
        }
    }
}
