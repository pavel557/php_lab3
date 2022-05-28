<?php

namespace App\Domain\GamedevStudios\Models\Factories;

use App\Domain\GamedevStudios\Models\GamedevStudio;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\GamedevStudios\Models\Model>
 */
class GamedevStudioFactory extends Factory
{
    protected $model = GamedevStudio::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = $this->faker;
        $start_date = $faker->dateTime();
        $title = $faker->jobTitle();
        return [
            'title' => $title,
            'address' => $faker->address(),
            'website' => 'www.' . $title . '.com',
            'number_employees' => $faker->numberBetween(1, 500),
            'created_at' => $start_date,
            'updated_at' => $faker->dateTimeBetween($start_date, $start_date->format('Y-m-d H:i:s') . ' +' . $faker->numberBetween(0, 400) . ' days')
        ];
    }
}
