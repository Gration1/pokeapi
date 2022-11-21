<?php

namespace App\Repositories\Team;

use App\Data\Team\TeamCreateData;
use App\Data\Team\TeamUpdateData;
use App\Models\Team;
use Illuminate\Support\Collection;

class TeamRepository implements TeamRepositoryInterface
{
    public function create(TeamCreateData $data): Team
    {
        return new Team($data->toArray());
    }

    public function all(): Collection
    {
        return Team::with('pokemon')->get();
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
