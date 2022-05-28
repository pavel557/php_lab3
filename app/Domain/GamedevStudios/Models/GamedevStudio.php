<?php

namespace App\Domain\GamedevStudios\Models;

use App\Domain\Games\Models\Game;
use App\Domain\GamedevStudios\Models\Factories\GamedevStudioFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GamedevStudio extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'address',
        'website',
        'number_employees',
        'created_at',
        'updated_at'
    ];

    public static function factory(): GamedevStudioFactory
    {
        return GamedevStudioFactory::new();
    }

    public function games(): HasMany
    {
        return $this->hasMany(Game::class);
    }
}
