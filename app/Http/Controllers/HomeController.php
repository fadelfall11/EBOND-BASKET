<?php

namespace App\Http\Controllers;

use App\Models\Actualite;
use App\Models\Categorie;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $categories = Categorie::with('coach')->get();
            $actualites = Actualite::latest()->take(3)->get();
        } catch (\Illuminate\Database\QueryException $e) {
            // DB not reachable: return empty collections to avoid crash
            $categories = collect();
            $actualites = collect();
        }
        
        return view('home', compact('categories', 'actualites'));
    }
}
