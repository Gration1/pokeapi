<?php

namespace App\Enums;

use App\Traits\InteractsWithStringValues;

enum PokemonSort: string
{
    use InteractsWithStringValues;

    case nameAsc = 'name-asc';
    case nameDesc = 'name-desc';
    case idAsc = 'id-asc';
    case idDesc = 'id-desc';
}
