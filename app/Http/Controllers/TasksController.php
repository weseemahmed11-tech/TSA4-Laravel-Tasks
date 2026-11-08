<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Mail\TaskCompleted;
use App\Models\Task;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class TasksController extends Controller
{
    public function index(): View
    {
        $tasks = Task::active()->orderBy('task_date')->get();

        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function show(Task $task): View
    {
        abort_if($task->is_archived, 404);

        return view('tasks.show', ['task' => $task]);
    }

    public function create(): View
    {
        return view('tasks.create', ['task' => new Task([
            'task_date' => now()->toDateString(),
            'status' => 'pending',
        ])]);
    }

    public function store(StoreTaskRequest $request): RedirectResponse
    {
        $task = Task::create($request->validated());

        return redirect()->route('tasks.show', $task)->with('status', 'Task created successfully.');
    }

    public function edit(Task $task): View
    {
        abort_if($task->is_archived, 404);

        return view('tasks.edit', ['task' => $task]);
    }

    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        abort_if($task->is_archived, 404);

        $wasDone = $task->status === 'done';
        $task->update($request->validated());

        if (! $wasDone && $task->status === 'done') {
            Mail::to(config('services.task_mail.recipient'))->send(new TaskCompleted($task));
        }

        return redirect()->route('tasks.show', $task)->with('status', 'Task updated successfully.');
    }

    public function destroy(Task $task): RedirectResponse
    {
        abort_if($task->is_archived, 404);

        $task->update(['is_archived' => true]);

        return redirect()->route('tasks.index')->with('status', 'Task archived successfully.');
    }
}
