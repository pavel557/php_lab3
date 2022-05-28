<?php

namespace App\Domain\GamedevStudios\Actions;

use App\Domain\Games\Models\Game;
use App\Domain\GamedevStudios\Models\GamedevStudio;

class DeleteGamedevStudioAction
{
    public function execute(int $gamedevStudioId): void
    {
        //Database triggers can resolve this code line. 
        Game::query()->where('gamedev_studio_id', '=', $gamedevStudioId)->update(['gamedev_studio_id' => NULL]);
        GamedevStudio::findOrFail($gamedevStudioId)->delete();
    }
}