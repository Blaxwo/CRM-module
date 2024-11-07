<?php

namespace App\Http\Controllers\HomeController;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }
}

