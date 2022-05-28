<?php

namespace App\Domain\Games\Models\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\GamedevStudios\Models\GamedevStudio;
use App\Domain\Games\Models\Game;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\Games\Models\Model>
 */
class GameFactory extends Factory
{
    protected $model = Game::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = $this->faker;
        return [
            'title' => $faker->jobTitle(),
            'description' => $faker->text(100),
            'gamedev_studio_id' => GamedevStudio::query()->inRandomOrder()->first()->id
        ];
    }
}
