<?php

namespace App\Http\Controllers;

use App\Models\EmploiDuTemps;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmploiDuTempsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categorie::with(['emploiDuTemps', 'coach'])->get();
        $jours = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];

        $minimesCategories = $categories->filter(function ($cat) {
            $nom = Str::lower(Str::ascii($cat->nom));
            return Str::contains($nom, 'minime');
        });

        $cadetsCategories = $categories->filter(function ($cat) {
            $nom = Str::lower(Str::ascii($cat->nom));
            return Str::contains($nom, 'cadet');
        });

        $groupes = [
            'minimes' => [
                'label' => 'Minimes (Garçons et Filles)',
                'categories' => $minimesCategories,
            ],
            'cadets' => [
                'label' => 'Cadets & Cadettes',
                'categories' => $cadetsCategories,
            ],
        ];

        return view('emploi-du-temps.index', compact('groupes', 'jours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categorie::all();
        return view('emploi-du-temps.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'categorie_id' => 'required|exists:categories,id',
            'jour' => 'required|in:lundi,mardi,mercredi,jeudi,vendredi,samedi,dimanche',
            'heure_debut' => 'required|date_format:H:i',
            'heure_fin' => 'required|date_format:H:i|after:heure_debut',
            'lieu' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        EmploiDuTemps::create($validated);

        return redirect()->route('emploi-du-temps.index')
            ->with('success', 'Entraînement ajouté avec succès!');
    }

    /**
     * Display the specified resource.
     */
    public function show(EmploiDuTemps $emploiDuTemps)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmploiDuTemps $emploiDuTemps)
    {
        $categories = Categorie::all();
        return view('emploi-du-temps.edit', compact('emploiDuTemps', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmploiDuTemps $emploiDuTemps)
    {
        $validated = $request->validate([
            'categorie_id' => 'required|exists:categories,id',
            'jour' => 'required|in:lundi,mardi,mercredi,jeudi,vendredi,samedi,dimanche',
            'heure_debut' => 'required|date_format:H:i',
            'heure_fin' => 'required|date_format:H:i|after:heure_debut',
            'lieu' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $emploiDuTemps->update($validated);

        return redirect()->route('emploi-du-temps.index')
            ->with('success', 'Entraînement modifié avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmploiDuTemps $emploiDuTemps)
    {
        $emploiDuTemps->delete();

        return redirect()->route('emploi-du-temps.index')
            ->with('success', 'Entraînement supprimé avec succès!');
    }
}
