<?php

namespace App\Models;

use App\Data\Pokemon\PokemonAbilityData;
use App\Data\Pokemon\PokemonMoveData;
use App\Data\Pokemon\PokemonStatData;
use App\Data\Pokemon\PokemonTypeData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\DataCollection;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Pokemon extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['name', 'types', 'height', 'weight', 'moves', 'order', 'species', 'stats', 'abilities', 'form'];

    protected $casts = [
        'types' => DataCollection::class . ':' . PokemonTypeData::class,
        'moves' => DataCollection::class . ':' . PokemonMoveData::class,
        'stats' => DataCollection::class . ':' . PokemonStatData::class,
        'abilities' => DataCollection::class . ':' . PokemonAbilityData::class,
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('front_default')->singleFile();
        $this->addMediaCollection('front_female')->singleFile();
        $this->addMediaCollection('front_shiny')->singleFile();
        $this->addMediaCollection('front_shiny_female')->singleFile();
        $this->addMediaCollection('back_default')->singleFile();
        $this->addMediaCollection('back_female')->singleFile();
        $this->addMediaCollection('back_shiny')->singleFile();
        $this->addMediaCollection('back_shiny_female')->singleFile();
    }
}
