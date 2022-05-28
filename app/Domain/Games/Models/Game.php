<?php

namespace App\Domain\Games\Models;

use App\Domain\Games\Models\Factories\GameFactory;
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
