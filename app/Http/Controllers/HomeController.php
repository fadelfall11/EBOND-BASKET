<?php

namespace App\Http\Controllers;

use App\Models\Actualite;
use App\Models\Categorie;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Categorie::with('coach')->get();
        $actualites = Actualite::latest()->take(3)->get();
        
        return view('home', compact('categories', 'actualites'));
    }
}
