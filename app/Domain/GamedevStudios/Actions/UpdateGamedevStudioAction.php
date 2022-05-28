<?php

namespace App\Domain\GamedevStudios\Actions;

use App\Domain\GamedevStudios\Models\GamedevStudio;

class UpdateGamedevStudioAction
{
    public function execute(int $gamedevStudioId, array $fields): GamedevStudio
    {
        unset($fields['created_at']);
        unset($fields['updated_at']);
        $gamedevStudio = GamedevStudio::findOrFail($gamedevStudioId);
        $gamedevStudio->update($fields);
        return $gamedevStudio;
    }
}