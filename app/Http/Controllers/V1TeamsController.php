<?php

namespace App\Http\Controllers;

use App\Data\Team\TeamCreateData;
use App\Data\Team\TeamResponseData;
use App\Services\Team\TeamServiceInterface;

class V1TeamsController extends Controller
{
    public function __construct(public TeamServiceInterface $teamService)
    {
    }

    public function create(TeamCreateData $data): TeamResponseData
    {
        return TeamResponseData::fromModel($this->teamService->create($data));
    }
}
