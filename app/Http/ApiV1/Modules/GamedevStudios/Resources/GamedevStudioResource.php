<?php

namespace App\Http\ApiV1\Modules\GamedevStudios\Resources;

use App\Http\ApiV1\Modules\Games\Resources\GameResource;
use App\Http\ApiV1\Utils\Resources\BaseJsonResource;
use DateTime;

/** @mixin \App\Domain\GamedevStudios\Models\GamedevStudio */
class GamedevStudioResource extends BaseJsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'address' => $this->address,
            'website' => $this->website,
            'number_employees' => $this->number_employees,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'games' => GameResource::collection($this->whenLoaded('games')),
        ];
    }
}