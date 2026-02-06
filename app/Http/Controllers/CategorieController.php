<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categorie::with('coach', 'joueurs')->get();
        $categoriesGarcons = $categories->where('genre', 'garcon');
        $categoriesFilles = $categories->where('genre', 'fille');
        
        return view('categories.index', compact('categories', 'categoriesGarcons', 'categoriesFilles'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorie $category)
    {
        $category->load(['coach', 'joueurs' => function($query) {
            $query->orderBy('capitaine', 'desc')->orderBy('numero');
        }]);
        
        return view('categories.show', ['categorie' => $category]);
    }
}
