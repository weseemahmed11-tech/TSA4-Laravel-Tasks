@extends('layouts.app')

@section('content')
    <section class="page-intro"><div class="eyebrow">Task details</div><h1>{{ $task->title }}</h1><p>Task #{{ $task->id }} in the Tasks for Today schedule.</p></section>
    <article class="card">
        <dl class="details"><div><dt>Task date</dt><dd>{{ $task->task_date->format('F j, Y') }}</dd></div><div><dt>Status</dt><dd><span class="badge {{ $task->status }}">{{ ucfirst($task->status) }}</span></dd></div><div><dt>Archive state</dt><dd>{{ $task->is_archived ? 'Archived' : 'Active' }}</dd></div></dl>
        <div class="actions">
            <a class="button secondary" href="{{ route('tasks.index') }}">Back to Tasks</a>
        @auth
                <a class="button" href="{{ route('tasks.edit', $task) }}">Edit task</a>
                <form class="inline-form" method="POST" action="{{ route('tasks.destroy', $task) }}" onsubmit="return confirm('Archive this task?')">
                    @csrf
                    @method('DELETE')
                    <button class="button archive-button" type="submit">Archive task</button>
                </form>
        @endauth
        </div>
    </article>
@endsection
