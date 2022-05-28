<?php

namespace App\Models;

use App\Domain\Games\Models\Factories\GameFactory;
use Database\Factories\GameFactory as FactoriesGameFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'gamedev_studio_id',
    ];

    public $timestamps = false;

    public static function factory(): GameFactory
    {
        return GameFactory::new();
    }
}
