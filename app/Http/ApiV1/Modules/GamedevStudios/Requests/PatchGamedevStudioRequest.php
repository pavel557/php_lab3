<?php

namespace App\Http\ApiV1\Modules\GamedevStudios\Requests;

use App\Http\ApiV1\Utils\Requests\BaseFormRequest;

class PatchGamedevStudioRequest extends BaseFormRequest
{
    public function rules(): array
    {
        $id = $this->route('gamedevStudioId');
        return [
            'title' => ['string'],
            'address' => ['string'],
            'website' => ['string'],
            'number_employees' => ['integer'],
        ];
    }
}