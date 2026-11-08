@extends('layouts.app')

@section('content')
    <section class="hero">
        <div>
            <div class="eyebrow">Tasks for Today Management System</div>
            <h1>Make today count.</h1>
            <p>Keep your priorities visible, organized, and ready for action with a simple Laravel task board.</p>
            <a class="button" href="{{ route('tasks.index') }}">View every task</a>
        </div>
        <div class="terminal-card" aria-label="Today's task summary">
            <div class="terminal-top"><span></span><span></span><span></span></div>
            <div class="terminal-line"><span>Date</span><span class="terminal-value">{{ now()->format('M d, Y') }}</span></div>
            <div class="terminal-line"><span>Today's tasks</span><span class="terminal-value">{{ $todayTasks->count() }}</span></div>
            <div class="terminal-line"><span>System status</span><span class="terminal-value">Focused</span></div>
        </div>
    </section>

    <section>
        <div class="section-heading"><div><div class="eyebrow">Today</div><h2>Your focus list</h2></div><p>Only tasks scheduled for today appear here.</p></div>
        <div class="cards">
            @forelse ($todayTasks as $task)
                <article class="card">
                    <div class="card-header"><div><h3>{{ $task->title }}</h3><div class="record-id">Task #{{ $task->id }}</div></div><span class="badge {{ $task->status }}">{{ ucfirst($task->status) }}</span></div>
                    <dl class="details"><div><dt>Scheduled</dt><dd>{{ $task->task_date->format('F j, Y') }}</dd></div><div><dt>Status</dt><dd>{{ ucfirst($task->status) }}</dd></div></dl>
                </article>
            @empty
                <div class="card"><h3>No tasks scheduled today</h3><p>Your focus list is clear.</p></div>
            @endforelse
        </div>
    </section>
@endsection
