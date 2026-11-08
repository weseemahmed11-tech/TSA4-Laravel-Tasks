@extends('layouts.app')

@section('content')
    <section class="page-intro"><div class="eyebrow">About the project</div><h1>Simple planning, clearly presented.</h1><p>The IT0049 TSA4 Tasks for Today Management System demonstrates Laravel migrations, seeders, Eloquent models, controllers, routes, Blade views, authentication, and task management working together.</p></section>
    <div class="about-grid">
        <div class="card"><strong>Tasks</strong><h3>Database-backed focus</h3><p>Every task is stored in MySQL and displayed through Eloquent queries.</p></div>
        <div class="card"><strong>Four</strong><h3>Focused pages</h3><p>Home, All Tasks, Profile, and About share one consistent navigation and layout.</p></div>
        <div class="card"><strong>W.A.</strong><h3>Developer</h3><p>This assessment was developed by Weseem Ahmed.</p></div>
    </div>
@endsection
