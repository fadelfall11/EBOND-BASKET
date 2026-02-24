<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        try {
            $coaches = Coach::all();
        } catch (\Illuminate\Database\QueryException $e) {
            // DB not reachable: return empty collection to avoid crash
            $coaches = collect();
        }
        return view('about', compact('coaches'));
    }
}
