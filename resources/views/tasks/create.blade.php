@extends('layouts.app')

@section('content')
    <section class="page-intro"><div class="eyebrow">Task management</div><h1>Create a task.</h1><p>Add a new item to the shared task schedule.</p></section>
    <div class="card form-card">
        <form method="POST" action="{{ route('tasks.store') }}">
            @include('tasks._form', ['submitLabel' => 'Save task'])
        </form>
    </div>
@endsection
