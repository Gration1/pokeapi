<?php

namespace App\Services\Team;

use App\Data\Team\TeamCreateData;
use App\Models\Team;
use App\Repositories\Team\TeamRepositoryInterface;

class TeamService implements TeamServiceInterface
{
    public function __construct(protected TeamRepositoryInterface $teamRepository)
    {
    }

    public function create(TeamCreateData $data): Team
    {
        $team = $this->teamRepository->create($data);
        $this->teamRepository->save($team);

        return $team;
    }
}
