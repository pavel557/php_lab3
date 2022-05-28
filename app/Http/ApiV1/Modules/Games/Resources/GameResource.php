<?php

namespace App\Http\ApiV1\Modules\Games\Resources;

use App\Http\ApiV1\Utils\Resources\BaseJsonResource;

/** @mixin \App\Domain\Atletes\Models\Atlete */
class GameResource extends BaseJsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'gamedev_studio_id' => $this->gamedev_studio_id
        ];
    }
}