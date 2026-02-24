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
        try {
            $categories = Categorie::with('coach', 'joueurs')->get();
            $categoriesGarcons = $categories->where('genre', 'garcon');
            $categoriesFilles = $categories->where('genre', 'fille');
        } catch (\Illuminate\Database\QueryException $e) {
            // DB not reachable: return empty collections to avoid crash
            $categories = collect();
            $categoriesGarcons = collect();
            $categoriesFilles = collect();
        }
        
        return view('categories.index', compact('categories', 'categoriesGarcons', 'categoriesFilles'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorie $category)
    {
        try {
            $category->load(['coach', 'joueurs' => function($query) {
                $query->orderBy('capitaine', 'desc')->orderBy('numero');
            }]);
        } catch (\Illuminate\Database\QueryException $e) {
            // DB not reachable: return empty relations to avoid crash
            $category->setRelation('coach', null);
            $category->setRelation('joueurs', collect());
        }
        
        return view('categories.show', ['categorie' => $category]);
    }
}
