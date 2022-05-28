<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Games\Models\Game;
use App\Domain\GamedevStudios\Models\GamedevStudio;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    protected $model = Atlete::class;
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
