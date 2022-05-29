<?php

namespace App\Http\ApiV1\Modules\GamedevStudios\Controllers;

use App\Domain\GamedevStudios\Actions\CreateGamedevStudioAction;
use App\Domain\GamedevStudios\Actions\DeleteGamedevStudioAction;
use App\Domain\GamedevStudios\Actions\GetGamedevStudioAction;
use App\Domain\GamedevStudios\Actions\PatchGamedevStudioAction;
use App\Domain\GamedevStudios\Actions\UpdateGamedevStudioAction;
use App\Http\ApiV1\Modules\GamedevStudios\Requests\CreateGamedevStudioRequest;
use App\Http\ApiV1\Modules\GamedevStudios\Requests\PatchGamedevStudioRequest;
use App\Http\ApiV1\Modules\GamedevStudios\Requests\UpdateGamedevStudioRequest;

use App\Http\ApiV1\Modules\GamedevStudios\Resources\GamedevStudioResource;
use App\Http\ApiV1\Utils\Resources\EmptyResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class GamedevStudiosController extends Controller
{
    public function create(CreateGamedevStudioRequest $request, CreateGamedevStudioAction $action): GamedevStudioResource
    {
        return new GamedevStudioResource($action->execute($request->validated()));
    }

    public function patch(int $addressId, PatchGamedevStudioRequest $request, PatchGamedevStudioAction $action): GamedevStudioResource
    {
        return new GamedevStudioResource($action->execute($addressId, $request->validated()));
    }

    public function update(int $addressId, UpdateGamedevStudioRequest $request, UpdateGamedevStudioAction $action): GamedevStudioResource
    {
        return new GamedevStudioResource($action->execute($addressId, $request->validated()));
    }

    public function delete(int $addressId, DeleteGamedevStudioAction $action): EmptyResource
    {
        $action->execute($addressId);
        return new EmptyResource();
    }

    public function get(int $addressId, GetGamedevStudioAction $action, Request $request): GamedevStudioResource
    {
        return new GamedevStudioResource($action->execute($addressId, $request));
    }
}
