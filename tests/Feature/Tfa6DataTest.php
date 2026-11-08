<?php

use App\Models\Task;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('home page displays only seeded tasks scheduled for today', function () {
    $this->seed(DatabaseSeeder::class);

    $this->get('/')
        ->assertOk()
        ->assertSee(['Review today\'s priorities', 'Plan the afternoon schedule', 'Send the daily progress update'])
        ->assertDontSee('Prepare tomorrow\'s task list');
});

test('tasks page displays all seeded tasks and profile displays one user', function () {
    $this->seed(DatabaseSeeder::class);

    $this->get('/tasks')
        ->assertOk()
        ->assertSee(['Review today\'s priorities', 'Prepare tomorrow\'s task list', 'Set weekly focus areas']);

    $this->get('/profile')
        ->assertOk()
        ->assertSee('Weseem Ahmed');

    $this->get('/about')
        ->assertOk()
        ->assertSee('Weseem Ahmed');

    expect(Task::count())->toBe(8)
        ->and(Task::query()->distinct('task_date')->count('task_date'))->toBe(4)
        ->and(User::count())->toBe(1);
});
