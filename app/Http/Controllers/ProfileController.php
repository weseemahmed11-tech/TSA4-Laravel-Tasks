<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        $user = User::query()->firstOrFail();

        return view('profile.index', ['user' => $user]);
    }
}
