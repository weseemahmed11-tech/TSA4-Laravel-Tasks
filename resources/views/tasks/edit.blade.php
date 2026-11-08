@extends('layouts.app')

@section('content')
    <section class="page-intro"><div class="eyebrow">Task management</div><h1>Edit task.</h1><p>Update the details for Task #{{ $task->id }}.</p></section>
    <div class="card form-card">
        <form method="POST" action="{{ route('tasks.update', $task) }}">
            @method('PUT')
            @include('tasks._form', ['submitLabel' => 'Save changes'])
        </form>
    </div>
@endsection
