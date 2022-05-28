<?php

namespace App\Domain\GamedevStudios\Actions;

use App\Domain\GamedevStudios\Models\GamedevStudio;
use DateTime;

class CreateGamedevStudioAction
{
    public function execute(array $fields): GamedevStudio
    {
        return GamedevStudio::create($fields);
    }
}