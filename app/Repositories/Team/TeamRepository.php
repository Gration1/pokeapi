<?php

namespace App\Repositories\Team;

use App\Data\Team\TeamCreateData;
use App\Models\Team;

class TeamRepository implements TeamRepositoryInterface
{
    public function create(TeamCreateData $data): Team
    {
        return new Team($data->toArray());
    }

    public function get(int $id): ?Team
    {
        return Team::with('pokemon')->find($id);
    }

    public function save(Team $team): void
    {
        $team->save();
    }
}
