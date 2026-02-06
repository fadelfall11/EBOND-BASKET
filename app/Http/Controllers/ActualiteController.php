<?php

namespace App\Http\Controllers;

use App\Models\Actualite;
use Illuminate\Http\Request;

class ActualiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $actualites = Actualite::latest()->paginate(9);
        return view('actualites.index', compact('actualites'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Actualite $actualite)
    {
        $actualitesRecentes = Actualite::latest()->where('id', '!=', $actualite->id)->take(3)->get();
        return view('actualites.show', compact('actualite', 'actualitesRecentes'));
    }
}
