<?php

use App\Mail\TaskCompleted;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

test('public pages are accessible and archived tasks are hidden', function () {
    User::factory()->create();
    $archivedTask = Task::factory()->create(['title' => 'Hidden archived task', 'is_archived' => true]);
    $activeTask = Task::factory()->create(['title' => 'Visible active task']);

    $this->get('/')->assertOk();
    $this->get('/tasks')->assertOk()->assertSee('Visible active task')->assertDontSee('Hidden archived task');
    $this->get('/tasks/'.$activeTask->id)->assertOk()->assertSee('Visible active task');
    $this->get('/profile')->assertOk();
    $this->get('/about')->assertOk();
    $this->get('/tasks/'.$archivedTask->id)->assertNotFound();
});

test('guests are redirected when managing tasks', function () {
    $task = Task::factory()->create();

    $this->get(route('tasks.create'))->assertRedirect(route('login'));
    $this->post(route('tasks.store'), [])->assertRedirect(route('login'));
    $this->get(route('tasks.edit', $task))->assertRedirect(route('login'));
    $this->put(route('tasks.update', $task), [])->assertRedirect(route('login'));
    $this->delete(route('tasks.destroy', $task))->assertRedirect(route('login'));
});

test('navigation and task controls match the authentication state', function () {
    $user = User::factory()->create();
    $task = Task::factory()->create(['title' => 'UI task']);

    $this->get(route('tasks.index'))
        ->assertOk()
        ->assertSee('Login')
        ->assertSee('Register')
        ->assertDontSee('Logout')
        ->assertSee('View')
        ->assertDontSee('Edit')
        ->assertDontSee('Archive');

    $this->actingAs($user)->get(route('tasks.index'))
        ->assertOk()
        ->assertSee('Logout')
        ->assertDontSee('Login')
        ->assertDontSee('Register')
        ->assertSee('View')
        ->assertSee('Edit')
        ->assertSee('Archive');

    $this->actingAs($user)->get(route('tasks.show', $task))
        ->assertOk()
        ->assertSee('Back to Tasks')
        ->assertSee('Archive state')
        ->assertSee('Edit task');
});

test('authenticated users can create edit update and archive tasks', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post(route('tasks.store'), [
        'title' => 'New managed task',
        'task_date' => '2026-11-10',
        'status' => 'pending',
    ])->assertRedirect();

    $task = Task::query()->where('title', 'New managed task')->firstOrFail();

    $this->actingAs($user)->get(route('tasks.edit', $task))->assertOk()->assertSee('New managed task');
    $this->actingAs($user)->put(route('tasks.update', $task), [
        'title' => 'Updated managed task',
        'task_date' => '2026-11-11',
        'status' => 'in progress',
    ])->assertRedirect(route('tasks.show', $task));

    expect($task->fresh()->title)->toBe('Updated managed task');

    $this->actingAs($user)->delete(route('tasks.destroy', $task))->assertRedirect(route('tasks.index'));

    expect($task->fresh()->is_archived)->toBeTrue();
    $this->get(route('tasks.index'))->assertDontSee('Updated managed task');
});

test('task validation preserves input and reports invalid fields', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->from(route('tasks.create'))->post(route('tasks.store'), [
        'title' => '',
        'task_date' => 'not-a-date',
        'status' => 'unknown',
    ])->assertRedirect(route('tasks.create'))
        ->assertSessionHasErrors(['title', 'task_date', 'status'])
        ->assertSessionHasInput('title', '');
});

test('mail is sent once when a task changes to done', function () {
    Mail::fake();
    $user = User::factory()->create();
    $task = Task::factory()->create(['status' => 'pending']);

    $this->actingAs($user)->put(route('tasks.update', $task), [
        'title' => $task->title,
        'task_date' => $task->task_date->format('Y-m-d'),
        'status' => 'done',
    ])->assertRedirect();

    Mail::assertSent(TaskCompleted::class, 1);

    $this->actingAs($user)->put(route('tasks.update', $task), [
        'title' => 'Still done',
        'task_date' => $task->task_date->format('Y-m-d'),
        'status' => 'done',
    ])->assertRedirect();

    Mail::assertSent(TaskCompleted::class, 1);
});
