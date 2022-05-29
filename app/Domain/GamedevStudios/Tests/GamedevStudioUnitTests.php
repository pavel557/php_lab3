<?php

use App\Domain\Games\Models\Game;
use App\Domain\GamedevStudios\Models\GamedevStudio;
use Tests\TestCase;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\deleteJson;
use function Pest\Laravel\getJson;
use function Pest\Laravel\patchJson;
use function Pest\Laravel\postJson;
use function Pest\Laravel\putJson;

uses(TestCase::class);
uses()->group('unit');

function format_date_util($date): string
{
    return $date->format('Y-m-d\TH:i:s.000000') . 'Z';
}

function get_time_diff_sec($date1, $date2): int
{
    $diff = strtotime(strval($date2)) - strtotime(strval($date1));
    return abs($diff);
}

$base_route = '/api/v1/gamedev-studios/';

//POST testing ...---...

test('POST: GamedevStudio created ', function () use ($base_route) {
    $studio = GamedevStudio::factory()->raw();
    $expected = [
        'data' => [
            'title' => $studio['title'],
            'address' => $studio['address'],
            'website' => $studio['website'],
            'number_employees' => $studio['number_employees'],
        ]
    ];
    postJson($base_route, $studio)
        ->assertStatus(201)
        ->assertJson($expected);
    assertDatabaseHas('gamedev_studios', $expected['data']);
});

test('POST: GamedevStudio not created couse unsetted value', function () use ($base_route) {
    $studio = GamedevStudio::factory()->raw();
    unset($studio['title']);
    $expected = [
        'data' => null
    ];
    postJson($base_route, $studio)
        ->assertStatus(400)
        ->assertJson($expected);
});

test('POST: GamedevStudio not created couse wrong entered value type', function () use ($base_route) {
    $studio = GamedevStudio::factory()->raw();
    $studio['number_employees'] = 'srting';
    $expected = [
        'data' => null
    ];
    postJson($base_route, $studio)
        ->assertStatus(400)
        ->assertJson($expected);
});

// DELETE testing ...---...

test('DELETE: GamedevStudio by id deleted', function () use ($base_route) {
    $studio = GamedevStudio::factory()->create();
    $expected = [
        'data' => null
    ];
    deleteJson($base_route . "{$studio->id}")
        ->assertStatus(200)
        ->assertJson($expected);
    assertDatabaseMissing('gamedev_studios', ['id' => $studio->id]);
});

test('DELETE: GamedevStudio not found', function () use ($base_route) {
    $wrongIdValue = GamedevStudio::query()->max('id') + 1000;
    $expected = [
        'data' => null
    ];
    deleteJson($base_route . "{$wrongIdValue}")
        ->assertStatus(404)
        ->assertJson($expected);
});

// GET testing ...---...

test('GET: GamedevStudio by id', function () use ($base_route) {
    $studio = GamedevStudio::query()->inRandomOrder()->first();
    $expected = [
        'data' => [
            'id' => $studio->id,
            'title' => $studio->title,
            'address' => $studio->address,
            'website' => $studio->website,
            'number_employees' => $studio->number_employees,
            'created_at' => format_date_util($studio->created_at),
            'updated_at' => format_date_util($studio->updated_at),
        ]
    ];
    getJson($base_route . "{$studio->id}")
        ->assertStatus(200)
        ->assertJson($expected);
});

test('GET: GamedevStudio with Games by id', function () use ($base_route) {

    $studio = GamedevStudio::factory()->create();
    $game = Game::factory()->create(['gamedev_studio_id' => $studio->id]);
    $expected = [
        'data' => [
            'id' => $studio['id'],
            'title' => $studio['title'],
            'address' => $studio['address'],
            'website' => $studio['website'],
            'number_employees' => $studio['number_employees'],
            'created_at' => format_date_util($studio['created_at']),
            'updated_at' => format_date_util($studio['updated_at']),
            'games' =>
            [
                [
                    'id' => $game['id'],
                    'title' => $game['title'],
                    'description' => $game['description'],
                    'gamedev_studio_id' => $studio['id'],
                ],
            ],
        ]
    ];
    getJson($base_route . "{$studio->id}?include=games")
        ->assertStatus(200)
        ->assertJson($expected);
});

test('GET: GamedevStudio not found', function () use ($base_route) {
    $wrongIdValue = GamedevStudio::query()->max('id') + 1000;
    $expected = [
        'data' => null
    ];
    getJson($base_route . "{$wrongIdValue}")
        ->assertStatus(404)
        ->assertJson($expected);
});

//PATCH testing ...---...

test('PATCH: GamedevStudio has updated', function () use ($base_route) {
    $studio = GamedevStudio::query()->inRandomOrder()->first();
    $fields = GamedevStudio::factory()->raw();
    unset($fields['title']);
    unset($fields['number_employees']);
    $expected = [
        'data' => [
            'id' => $studio->id,
            'title' => $studio->title,
            'address' => $fields['address'],
            'website' => $fields['website'],
            'number_employees' => $studio->number_employees,
            'created_at' => format_date_util($studio['created_at']),
        ]
    ];
    patchJson($base_route . "{$studio->id}", $fields)
        ->assertStatus(200)
        ->assertJson($expected);
    $expected['id'] = $studio->id;
    assertDatabaseHas('gamedev_studios', $expected['data']);
});

test('PATCH: GamedevStudio uncorrect id not updating', function () use ($base_route) {
    $wrongIdValue = GamedevStudio::query()->max('id') + 1000;
    $fields = GamedevStudio::factory()->raw();
    $expected = [
        'data' => null
    ];
    patchJson($base_route . "{$wrongIdValue}", $fields)
        ->assertStatus(404)
        ->assertJson($expected);
});

//PUT testing ...---...

test('PUT: GamedevStudio all fields updated', function () use ($base_route) {
    $studio = GamedevStudio::query()->inRandomOrder()->first();
    $fields = GamedevStudio::factory()->raw();
    $expected = [
        'data' => [
            'title' => $fields['title'],
            'address' => $fields['address'],
            'website' => $fields['website'],
            'number_employees' => $fields['number_employees'],
            'created_at' => format_date_util($studio->created_at),
        ]
    ];
    putJson($base_route . "{$studio->id}", $fields)
        ->assertStatus(200)
        ->assertJson($expected);
    $expected['id'] = $studio->id;
    assertDatabaseHas('gamedev_studios', $expected['data']);
});

test('PUT: GamedevStudio has no updated without required fields', function () use ($base_route) {
    $studio = GamedevStudio::query()->inRandomOrder()->first();
    $fields = GamedevStudio::factory()->raw();
    unset($fields['website']);
    $expected = [
        'data' => null
    ];
    putJson($base_route . "{$studio->id}", $fields)
        ->assertStatus(400)
        ->assertJson($expected);
});

test('PUT: GamedevStudio uncorrect id', function () use ($base_route) {
    $wrongIdValue = GamedevStudio::query()->max('id') + 1000;
    $fields = GamedevStudio::factory()->raw();
    $expected = [
        'data' => null
    ];
    patchJson($base_route . "{$wrongIdValue}", $fields)
        ->assertStatus(404)
        ->assertJson($expected);
});