@extends('layouts.app')

@section('content')
    <section class="page-intro"><div class="eyebrow">Task overview</div><h1>Every task, one view.</h1><p>Browse the complete schedule in ascending task-date order.</p>@auth<a class="button" href="{{ route('tasks.create') }}">Create task</a>@endauth</section>
    <div class="cards">
        @forelse ($tasks as $task)
            <article class="card">
                <div class="card-header"><div><h3><a href="{{ route('tasks.show', $task) }}">{{ $task->title }}</a></h3><div class="record-id">Task #{{ $task->id }}</div></div><span class="badge {{ $task->status }}">{{ ucfirst($task->status) }}</span></div>
                <dl class="details"><div><dt>Task date</dt><dd>{{ $task->task_date->format('F j, Y') }}</dd></div><div><dt>Status</dt><dd>{{ ucfirst($task->status) }}</dd></div></dl>
                <div class="actions">
                    <a class="button secondary" href="{{ route('tasks.show', $task) }}">View</a>
                    @auth
                        <a class="button secondary" href="{{ route('tasks.edit', $task) }}">Edit</a>
                        <form class="inline-form" method="POST" action="{{ route('tasks.destroy', $task) }}" onsubmit="return confirm('Archive this task?')">
                            @csrf
                            @method('DELETE')
                            <button class="button archive-button" type="submit">Archive</button>
                        </form>
                    @endauth
                </div>
            </article>
        @empty
            <article class="card"><h3>No active tasks</h3><p>There are no tasks available in the schedule.</p></article>
        @endforelse
    </div>
@endsection
