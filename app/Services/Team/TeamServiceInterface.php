<?php

namespace App\Services\Team;

use App\Data\Team\TeamCreateData;
use App\Models\Team;

interface TeamServiceInterface
{
    function create(TeamCreateData $data): Team;
    function get(int $id): Team;
}
