<?php

namespace App\Http\Controllers;

use App\Models\Url;

class MainController extends Controller
{
    public function index()
    {
        $urls = Url::latest()->take(10)->get();
        return view('welcome', compact('urls'));
    }
}
