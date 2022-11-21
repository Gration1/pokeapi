<?php

namespace App\Http\Controllers;

use App\Data\Team\TeamCreateData;
use App\Data\Team\TeamResponseData;
use App\Data\Team\TeamUpdateData;
use App\Services\Team\TeamServiceInterface;
use Spatie\LaravelData\DataCollection;

class V1TeamsController extends Controller
{
    public function __construct(public TeamServiceInterface $teamService)
    {
    }

    public function index(): DataCollection
    {
        return TeamResponseData::collection($this->teamService->all());
    }

    public function create(TeamCreateData $data): TeamResponseData
    {
        return TeamResponseData::fromModel($this->teamService->create($data));
    }

    public function get(int $id): TeamResponseData
    {
        return TeamResponseData::from($this->teamService->get($id));
    }

    public function update(int $id, TeamUpdateData $data): TeamResponseData
    {
        return TeamResponseData::from($this->teamService->update($id, $data));
    }
}
