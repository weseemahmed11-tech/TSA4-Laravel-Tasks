<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        $todayTasks = Task::active()
            ->whereDate('task_date', Carbon::today())
            ->orderBy('task_date')
            ->get();

        return view('pages.home', ['todayTasks' => $todayTasks]);
    }

    public function about(): View
    {
        return view('pages.about');
    }
}
