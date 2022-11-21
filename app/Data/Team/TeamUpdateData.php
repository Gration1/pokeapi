<?php

namespace App\Data\Team;

use Illuminate\Validation\Rule;
use Spatie\LaravelData\Data;

class TeamUpdateData extends Data
{
    public function __construct(public array $pokemons)
    {
    }

    public static function rules(): array
    {
        return [
            'pokemons' => ['required', 'array', 'min:0', 'max:6'],
            'pokemons.*' => ['required', Rule::exists('pokemon', 'id')],
        ];
    }
}
