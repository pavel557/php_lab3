<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Domain\GamedevStudios\Models\GamedevStudio::factory()->count(10)->create();
        \App\Domain\Games\Models\Game::factory()->count(30)->create();
    }
}
