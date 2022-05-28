<?php

namespace App\Domain\GamedevStudios\Actions;

use App\Domain\GamedevStudios\Models\GamedevStudio;
use Illuminate\Http\Request;

class GetGamedevStudioAction
{
    public function execute(int $gamedevStudioId, Request $request): GamedevStudio
    {
        $query = GamedevStudio::query();
        if ($request->get('include') === 'games') {
            $query->with('games');
        }
        return $query->findOrFail($gamedevStudioId);
    }
}