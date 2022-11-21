<?php

namespace App\Repositories\Team;

use App\Data\Team\TeamCreateData;
use App\Models\Team;
use Illuminate\Support\Collection;

interface TeamRepositoryInterface
{
    /**
     * @return Collection<\App\Models\Team>
     */
    function all(): Collection;
    function create(TeamCreateData $data): Team;
    function get(int $id): ?Team;
    function save(Team $team): void;
}
