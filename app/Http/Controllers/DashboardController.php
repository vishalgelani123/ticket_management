<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $usersCount = User::role('user')->count();
        return view('backend.dashboard.admin.home', compact('usersCount'));
    }
}
