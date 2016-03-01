<?php

namespace Valkyrie\Laracraft\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('laracraft.dashboard.index');
    }
}