<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $coaches = Coach::all();
        return view('about', compact('coaches'));
    }
}
