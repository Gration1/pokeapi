<?php

namespace App\Repositories\Team;

use App\Data\Team\TeamCreateData;
use App\Models\Team;

interface TeamRepositoryInterface
{
    function create(TeamCreateData $data): Team;
    function get(int $id): ?Team;
    function save(Team $team): void;
}
