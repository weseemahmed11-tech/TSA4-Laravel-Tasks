<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'username' => 'weseem.ahmed',
            'full_name' => 'Weseem Ahmed',
            'name' => 'Weseem Ahmed',
            'email' => 'weseem.ahmed@example.com',
            'password' => Hash::make('password'),
        ]);

        $today = Carbon::today();

        Task::insert([
            ['title' => 'Review today\'s priorities', 'status' => 'pending', 'task_date' => $today],
            ['title' => 'Plan the afternoon schedule', 'status' => 'in progress', 'task_date' => $today],
            ['title' => 'Send the daily progress update', 'status' => 'completed', 'task_date' => $today],
            ['title' => 'Prepare tomorrow\'s task list', 'status' => 'pending', 'task_date' => $today->copy()->addDay()],
            ['title' => 'Organize project notes', 'status' => 'pending', 'task_date' => $today->copy()->addDay()],
            ['title' => 'Review the previous day\'s results', 'status' => 'completed', 'task_date' => $today->copy()->subDay()],
            ['title' => 'Archive completed work', 'status' => 'completed', 'task_date' => $today->copy()->subDay()],
            ['title' => 'Set weekly focus areas', 'status' => 'pending', 'task_date' => $today->copy()->addDays(2)],
        ]);
    }
}
