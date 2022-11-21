<?php

namespace App\Services\Team;

use App\Data\Team\TeamCreateData;
use App\Models\Team;
use App\Repositories\Team\TeamRepositoryInterface;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\HttpException;

class TeamService implements TeamServiceInterface
{
    public function __construct(protected TeamRepositoryInterface $teamRepository)
    {
    }

    public function all(): Collection
    {
        return $this->teamRepository->all();
    }

    public function create(TeamCreateData $data): Team
    {
        $team = $this->teamRepository->create($data);
        $this->teamRepository->save($team);

        return $team;
    }

    public function get(int $id): Team
    {
        $team = $this->teamRepository->get($id);

        if ($team === null) {
            throw new HttpException(404, 'Team not found');
        }

        return $team;
    }
}
