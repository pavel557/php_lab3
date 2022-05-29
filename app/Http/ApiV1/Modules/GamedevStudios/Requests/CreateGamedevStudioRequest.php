<?php

namespace App\Http\ApiV1\Modules\GamedevStudios\Requests;

use App\Http\ApiV1\Utils\Requests\BaseFormRequest;

class CreateGamedevStudioRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'address' => ['required', 'string'],
            'website' => ['required', 'string'],
            'number_employees' => ['required', 'integer'],
        ];
    }
}
