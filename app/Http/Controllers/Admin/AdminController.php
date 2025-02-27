<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
        ]);
    }
}
