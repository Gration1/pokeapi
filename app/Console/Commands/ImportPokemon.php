<?php

namespace App\Console\Commands;

use App\Data\Pokemon\PokemonAbilityData;
use App\Data\Pokemon\PokemonCreateData;
use App\Data\Pokemon\PokemonMoveData;
use App\Data\Pokemon\PokemonMoveVersionGroupDetail;
use App\Data\Pokemon\PokemonSpriteData;
use App\Data\Pokemon\PokemonStatData;
use App\Data\Pokemon\PokemonTypeData;
use App\Services\Pokemon\PokemonServiceInterface;
use Illuminate\Console\Command;

class ImportPokemon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:pokemon {path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import pokemon from specified JSON file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(PokemonServiceInterface $pokemonService)
    {
        $this->info('importing Pokemon...');

        $data = $this->getDataFromFile();
        $bar = $this->output->createProgressBar(count($data));
        $bar->start();

        foreach (array_chunk($data, 20) as $dataChunk) {
            $createDTOs = $this->mapDataToDTOs($dataChunk);
            $pokemonService->import($createDTOs);
            $bar->advance(count($dataChunk));
        }
        $bar->finish();
        return Command::SUCCESS;
    }

    protected function getDataFromFile(): array
    {
        return json_decode(file_get_contents(storage_path($this->argument('path'))));
    }

    protected function mapDataToDTOs(array $data): array
    {
        return array_map(
            fn($dataEntry) => new PokemonCreateData(
                name: $dataEntry->name,
                sprites: new PokemonSpriteData(
                    front_default: $dataEntry->sprites->front_default,
                    front_female: $dataEntry->sprites->front_female,
                    front_shiny: $dataEntry->sprites->front_shiny,
                    front_shiny_female: $dataEntry->sprites->front_shiny_female,
                    back_default: $dataEntry->sprites->back_default,
                    back_female: $dataEntry->sprites->back_female,
                    back_shiny: $dataEntry->sprites->back_shiny,
                    back_shiny_female: $dataEntry->sprites->back_shiny_female,
                ),
                types: PokemonTypeData::collection(
                    array_map(
                        fn($type) => [
                            'type' => $type->type->name,
                            'slot' => $type->slot,
                        ],
                        $dataEntry->types,
                    ),
                ),
                height: $dataEntry->height,
                weight: $dataEntry->weight,
                moves: PokemonMoveData::collection(
                    array_map(
                        fn($move) => [
                            'move' => $move->move->name,
                            'version_group_details' => PokemonMoveVersionGroupDetail::collection(
                                array_map(
                                    fn($versionGroupDetail) => [
                                        'move_learn_method' => $versionGroupDetail->move_learn_method->name,
                                        'version_group' => $versionGroupDetail->version_group->name,
                                        'level_learned_at' => $versionGroupDetail->level_learned_at,
                                    ],
                                    $move->version_group_details,
                                ),
                            ),
                        ],
                        $dataEntry->moves,
                    ),
                ),
                order: $dataEntry->order,
                species: $dataEntry->species->name,
                stats: PokemonStatData::collection(array_map(fn($stat) => ['type' => $stat->stat->name, 'base_stat' => $stat->base_stat, 'effort' => $stat->effort], $dataEntry->stats)),
                abilities: PokemonAbilityData::collection(
                    array_map(fn($ability) => ['ability' => $ability->ability->name, 'is_hidden' => $ability->is_hidden, 'slot' => $ability->slot], $dataEntry->abilities),
                ),
                form: $dataEntry->forms[0]->name,
            ),
            $data,
        );
    }
}
