<?php

namespace App\Models;

use App\Data\Pokemon\PokemonAbilityData;
use App\Data\Pokemon\PokemonMoveData;
use App\Data\Pokemon\PokemonStatData;
use App\Data\Pokemon\PokemonTypeData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\DataCollection;

class Pokemon extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'types', 'height', 'weight', 'moves', 'order', 'species', 'stats', 'abilities', 'form'];

    protected $casts = [
        'types' => DataCollection::class . ':' . PokemonTypeData::class,
        'moves' => DataCollection::class . ':' . PokemonMoveData::class,
        'stats' => DataCollection::class . ':' . PokemonStatData::class,
        'abilities' => DataCollection::class . ':' . PokemonAbilityData::class,
    ];
}
