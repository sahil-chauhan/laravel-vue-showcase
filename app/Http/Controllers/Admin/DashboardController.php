<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        // $this->middleware('Admin');
    }

    public function index()
    {
        return view('admin.dashboard');
    }
}
