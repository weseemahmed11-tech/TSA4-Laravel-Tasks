@extends('layouts.app')

@section('content')
    <section class="page-intro"><div class="eyebrow">Profile</div><h1>{{ $user->full_name }}</h1><p>The single profile record currently connected to this Tasks for Today workspace.</p></section>
    <article class="card">
        <div class="card-header"><div><h3>{{ $user->full_name }}</h3><div class="record-id">Profile #{{ $user->id }}</div></div><span class="badge">Active</span></div>
        <dl class="details"><div><dt>Username</dt><dd>{{ $user->username }}</dd></div><div><dt>Email</dt><dd>{{ $user->email }}</dd></div></dl>
    </article>
@endsection
