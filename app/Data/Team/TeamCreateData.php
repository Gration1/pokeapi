<?php

namespace App\Data\Team;

use Spatie\LaravelData\Data;

class TeamCreateData extends Data
{
    public function __construct(public string $name)
    {
    }
}
