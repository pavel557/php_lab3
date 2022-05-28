<?php

namespace App\Http\ApiV1\Utils\Resources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class EmptyResource extends JsonResource
{
    function __construct()
    {
        return new JsonResponse(data: null);
    }
}