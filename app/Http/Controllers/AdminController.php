<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function profile()
    {
        return view('admin.profile');
    }

    public function settings()
    {
        return view('admin.settings');
    }
}
