<?php

namespace App\Services\Pokemon;

use App\Data\PaginationMetaData;
use App\Data\Pokemon\PokemonIndexData;
use App\Data\Pokemon\PokemonPaginatedIndexData;
use App\Data\Pokemon\PokemonPaginatedResponseData;
use App\Data\Pokemon\PokemonSearchData;
use App\Data\Pokemon\PokemonSpriteData;
use App\Enums\PokemonSort;
use App\Models\Pokemon;
use App\Repositories\Pokemon\PokemonRepositoryInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
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

    public function search(PokemonSearchData $data): Collection
    {
        return $this->pokemonRepository->search($data);
    }

    public function index(PokemonIndexData $data): Collection
    {
        return $this->pokemonRepository->all($data->sort);
    }

    public function paginated(PokemonPaginatedIndexData $data): PokemonPaginatedResponseData
    {
        if ($data->limit === 0) {
            $data->limit = 10;
        }

        $paginationResult = $this->pokemonRepository->paginated($data);

        // TODO: this could use some improvement
        return new PokemonPaginatedResponseData(
            $paginationResult->data,
            new PaginationMetaData(
                next: $this->getNext($data->limit, $data->offset, $paginationResult->total, $data->sort),
                previous: $this->getPrevious($data->limit, $data->offset, $data->sort),
                total: $paginationResult->total,
                pages: round($paginationResult->total / ($data->limit ?? 10)),
                page: round($data->offset / ($data->limit ?? 10)),
            ),
        );
    }

    public function import(array $pokemonCreateData): void
    {
        $this->pokemonRepository->upsert($pokemonCreateData);
        $this->attachSprites($pokemonCreateData);
    }

    protected function getNext(?int $limit, ?int $offset, int $total, ?PokemonSort $sort): ?string
    {
        if ($offset >= $total - ($limit ?? 10)) {
            return null;
        }

        return route('v2-pokemon-index', [
            'limit' => $limit,
            'offset' => $offset + ($limit ?? 10),
            'sort' => $sort,
        ]);
    }

    protected function getPrevious(?int $limit, ?int $offset, ?PokemonSort $sort): ?string
    {
        $offsetResult = ($offset ?? 0) - ($limit ?? 10);
        if ($offsetResult < 0) {
            return null;
        }
        if ($offsetResult === 0) {
            return route('v2-pokemon-index', [
                'limit' => $limit,
                'offset' => null,
                'sort' => $sort,
            ]);
        }
        return route('v2-pokemon-index', [
            'limit' => $limit,
            'offset' => $offsetResult,
            'sort' => $sort,
        ]);
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
